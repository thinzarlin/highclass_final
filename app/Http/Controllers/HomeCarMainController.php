<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\City;
use App\Models\DailyCarList;
use App\Models\GatePercent;
use App\Models\HomeCarMain;
use App\Models\OwnerMainSetting;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCarMainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        if ($request->has(['start_date', 'end_date'])) {
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-t');
        }

        $mains = HomeCarMain::whereBetween('in_date', [$start_date, $end_date])
            ->orderBy('ref_no', 'desc')
            ->get();

        return view('home-car-mains.index', compact('mains', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now();
        $daily_cars = DailyCarList::whereDate('date', $today)->whereDoesntHave('main')->orderBy('sr_no')->get();
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $settings = OwnerMainSetting::all();
        $cities = City::orderBy('en_name')->get();
        $gate_percents = GatePercent::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->orWhereNull('end_date')
            ->where('home_car', true)
            ->get();
        $ref_no = HomeCarMain::generateRefNo($today->format('Ym'));

        return view('home-car-mains.create', compact('tours', 'cars', 'daily_cars', 'settings', 'cities', 'gate_percents', 'ref_no', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'out_date' => 'required',
            'in_date' => 'required',
            'daily_car_list_id' => 'required',
            // 'ticket_line_no' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $ref_no = HomeCarMain::generateRefNo($in_date->format('Ym'));
        $daily_car_list = DailyCarList::find($request->daily_car_list_id);
        $tickets = [];
        $out_cargos = [];

        for ($i = 0; $i < ($request->max_ticket_line_no - 1); $i++) {
            $tickets[] = [
                'line_no' => $request->ticket_line_no[$i],
                'type' => $request->ticket_type[$i],
                'people' => $request->ticket_people[$i],
                'amount' => $request->ticket_amount[$i],
                'remark' => $request->ticket_remark[$i],
            ];
        }

        for ($i = 0; $i < ($request->max_out_cargo_line_no - 1); $i++) {
            $out_cargos[] = [
                'line_no' => $request->out_cargo_line_no[$i],
                'city_id' => $request->out_cargo_city_id[$i],
                'credit_cargo' => $request->out_credit_cargo[$i],
                'deli' => $request->out_cargo_deli[$i],
                'credit_khauk_to' => $request->out_credit_khauk_to[$i],
                'site_shin' => $request->out_site_shin[$i],
                'percent' => $request->out_cargo_percent[$i],
                'paid' => $request->out_cargo_paid[$i],
            ];
        }

        $data = HomeCarMain::create([
            'ref_no' => $ref_no,
            'out_date' => Carbon::parse($request->out_date),
            'in_date' => $in_date,
            'tour_id' => $daily_car_list->tour_id,
            'car_id' => $daily_car_list->car_id,
            'daily_car_list_id' => $daily_car_list->id,

            'tickets' => $tickets,
            'total_people' => $request->total_people,
            'total_ticket' => $request->total_ticket,
            'insurance' => $request->insurance,
            'ticket_income' => $request->ticket_income,

            'total_cargo' => $request->total_cargo,
            'cash_cargo' => $request->cash_cargo,
            'credit_cargo' => $request->credit_cargo,
            'cargo_bd' => $request->cargo_bd,
            'lu_par_cargo' => $request->lu_par_cargo,
            'out_cargos' => $out_cargos,
            'cargo_income' => $request->cargo_income,

            'grand_total' => $request->grand_total,
            'gate_percent' => $request->gate_percent,
            'gate_commission' => $request->gate_commission,

            'water_small_qty' => $request->water_small_qty,
            'water_small_amt' => $request->water_small_amt,
            'water_large_qty' => $request->water_large_qty,
            'water_large_amt' => $request->water_large_amt,
            'drink_qty' => $request->drink_qty,
            'drink_amt' => $request->drink_amt,
            'snack_qty' => $request->snack_qty,
            'snack_amt' => $request->snack_amt,
            'snack_special_qty' => $request->snack_special_qty,
            'snack_special_amt' => $request->snack_special_amt,
            'towel_qty' => $request->towel_qty,
            'towel_amt' => $request->towel_amt,
            'plastic_bag_qty' => $request->plastic_bag_qty,
            'plastic_bag_amt' => $request->plastic_bag_amt,
            'candy_qty' => $request->candy_qty,
            'candy_amt' => $request->candy_amt,
            'guest_reg' => $request->guest_reg,
            'medicine' => $request->medicine,
            'coffee' => $request->coffee,
            'coffee_cup' => $request->coffee_cup,
            'ticket_disc' => $request->ticket_disc,
            'total_expense' => $request->total_expense,

            'pot_sat' => $request->pot_sat,
            'la_tha' => $request->la_tha,
            'copy' => $request->copy,
            'total_rta' => $request->total_rta,

            'ygn_lan_tg_ticket' => $request->ygn_lan_tg_ticket,
            'lan_tg_ticket' => $request->lan_tg_ticket,
            'gate_out' => $request->gate_out,

            'ferry' => $request->ferry,
            'ask_khauk_to' => $request->ask_khauk_to,
            'deli' => $request->deli,
            'khauk_to' => $request->khauk_to,
            'other_expense' => $request->other_expense,
            'site_shin' => $request->site_shin,

            'total' => $request->total,

            'remark' => $request->remark,
            'created_user_id' => Auth::id()
        ]);

        // return redirect()->route('home-car-mains.index');
        return redirect()->route('home-car-mains.edit', $data->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeCarMain $homeCarMain)
    {
        $date = Carbon::parse($homeCarMain->in_date);
        $daily_cars = DailyCarList::whereDate('date', $date)
            ->where(function ($query) use ($homeCarMain) {
                $query->whereDoesntHave('main')
                    ->orWhere('id', $homeCarMain->daily_car_list_id);
            })
            ->orderBy('sr_no')
            ->get();
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $settings = OwnerMainSetting::all();
        $cities = City::orderBy('en_name')->get();
        $gate_percents = GatePercent::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->orWhereNull('end_date')
            ->where('home_car', true)
            ->get();

        $homeCarMain->in_date = $date->format('d-m-Y');
        $homeCarMain->out_date = Carbon::parse($homeCarMain->out_date)->format('d-m-Y');

        return view('home-car-mains.edit', compact('homeCarMain', 'tours', 'cars', 'daily_cars', 'settings', 'cities', 'gate_percents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeCarMain $homeCarMain)
    {
        $validated = $request->validate([
            'out_date' => 'required',
            'in_date' => 'required',
            'daily_car_list_id' => 'required',
            // 'ticket_line_no' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $old_in_date = Carbon::parse($homeCarMain->in_date);

        $ref_no = $homeCarMain->ref_no;
        $daily_car_list = $homeCarMain->daily_car_list;

        if ($in_date->month != $old_in_date->month) {
            $ref_no = HomeCarMain::generateRefNo($in_date->format('Ym'));
            $daily_car_list = DailyCarList::find($request->daily_car_list_id);
        }
        $tickets = [];
        $out_cargos = [];

        for ($i = 0; $i < ($request->max_ticket_line_no - 1); $i++) {
            $tickets[] = [
                'line_no' => $request->ticket_line_no[$i],
                'type' => $request->ticket_type[$i],
                'people' => $request->ticket_people[$i],
                'amount' => $request->ticket_amount[$i],
                'remark' => $request->ticket_remark[$i],
            ];
        }

        for ($i = 0; $i < ($request->max_out_cargo_line_no - 1); $i++) {
            $out_cargos[] = [
                'line_no' => $request->out_cargo_line_no[$i],
                'city_id' => $request->out_cargo_city_id[$i],
                'credit_cargo' => $request->out_credit_cargo[$i],
                'deli' => $request->out_cargo_deli[$i],
                'credit_khauk_to' => $request->out_credit_khauk_to[$i],
                'site_shin' => $request->out_site_shin[$i],
                'percent' => $request->out_cargo_percent[$i],
                'paid' => $request->out_cargo_paid[$i],
            ];
        }

        $data = $homeCarMain->update([
            'ref_no' => $ref_no,
            'out_date' => Carbon::parse($request->out_date),
            'in_date' => $in_date,
            'tour_id' => $daily_car_list->tour_id,
            'car_id' => $daily_car_list->car_id,
            'daily_car_list_id' => $daily_car_list->id,

            'tickets' => $tickets,
            'total_people' => $request->total_people,
            'total_ticket' => $request->total_ticket,
            'insurance' => $request->insurance,
            'ticket_income' => $request->ticket_income,

            'total_cargo' => $request->total_cargo,
            'cash_cargo' => $request->cash_cargo,
            'credit_cargo' => $request->credit_cargo,
            'cargo_bd' => $request->cargo_bd,
            'lu_par_cargo' => $request->lu_par_cargo,
            'out_cargos' => $out_cargos,
            'cargo_income' => $request->cargo_income,

            'grand_total' => $request->grand_total,
            'gate_percent' => $request->gate_percent,
            'gate_commission' => $request->gate_commission,

            'water_small_qty' => $request->water_small_qty,
            'water_small_amt' => $request->water_small_amt,
            'water_large_qty' => $request->water_large_qty,
            'water_large_amt' => $request->water_large_amt,
            'drink_qty' => $request->drink_qty,
            'drink_amt' => $request->drink_amt,
            'snack_qty' => $request->snack_qty,
            'snack_amt' => $request->snack_amt,
            'snack_special_qty' => $request->snack_special_qty,
            'snack_special_amt' => $request->snack_special_amt,
            'towel_qty' => $request->towel_qty,
            'towel_amt' => $request->towel_amt,
            'plastic_bag_qty' => $request->plastic_bag_qty,
            'plastic_bag_amt' => $request->plastic_bag_amt,
            'candy_qty' => $request->candy_qty,
            'candy_amt' => $request->candy_amt,
            'guest_reg' => $request->guest_reg,
            'medicine' => $request->medicine,
            'coffee' => $request->coffee,
            'coffee_cup' => $request->coffee_cup,
            'ticket_disc' => $request->ticket_disc,
            'total_expense' => $request->total_expense,

            'pot_sat' => $request->pot_sat,
            'la_tha' => $request->la_tha,
            'copy' => $request->copy,
            'total_rta' => $request->total_rta,

            'ygn_lan_tg_ticket' => $request->ygn_lan_tg_ticket,
            'lan_tg_ticket' => $request->lan_tg_ticket,
            'gate_out' => $request->gate_out,

            'ferry' => $request->ferry,
            'ask_khauk_to' => $request->ask_khauk_to,
            'deli' => $request->deli,
            'khauk_to' => $request->khauk_to,
            'other_expense' => $request->other_expense,
            'site_shin' => $request->site_shin,

            'total' => $request->total,

            'remark' => $request->remark,
            'updated_user_id' => Auth::id()
        ]);

        // return redirect()->route('home-car-mains.index');
        return redirect()->route('home-car-mains.edit', $homeCarMain->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeCarMain $homeCarMain)
    {
        $homeCarMain->delete();
        return back();
    }

    public function getInDateRelatedInfo(Request $request)
    {
        $in_date = Carbon::parse($request->query('in_date'));
        $refNo = HomeCarMain::generateRefNo($in_date->format('Ym'));
        $daily_cars = DailyCarList::whereDate('date', $in_date->format('Y-m-d'))
            ->whereDoesntHave('main')->orderBy('sr_no')->get();
        $gate_percents = GatePercent::where('start_date', '<=', $in_date)
            ->where('end_date', '>=', $in_date)
            ->orWhereNull('end_date')
            ->where('home_car', true)
            ->get();

        return response()->json([
            'ref_no' => $refNo,
            'daily_cars' => $daily_cars,
            'gate_percents' => $gate_percents,
        ]);
    }

    public function generateRefNo(Request $request)
    {
        $inDate = $request->query('in_date');
        $refNo = HomeCarMain::generateRefNo($inDate);
        return response()->json(['ref_no' => $refNo]);
    }
}
