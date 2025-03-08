<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\DailyCarList;
use App\Models\Diesel;
use App\Models\DieselShop;
use App\Models\Stock;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DieselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        if ($request->has(['in_date'])) {
            $in_date = Carbon::parse($request->in_date);
            $daily_car_list_id = $request->daily_car_list_id;
        } else {
            $in_date = Carbon::now();
            $daily_car_list_id = null;
        }

        $daily_cars = DailyCarList::whereDate('date', $in_date->format('Y-m-d'))->orderBy('sr_no')->get();
        $query = Diesel::query()->whereDate('in_date', $in_date);

        if ($daily_car_list_id) {
            $query->where('daily_car_list_id', $daily_car_list_id);
        }

        $diesels = $query->orderBy('ref_no', 'desc')->get();
        $in_date = $in_date->format('d-m-Y');

        $total_liters = $diesels->sum('liter');
        $total_amount = $diesels->sum('amount');

        return view('diesels.index', compact('diesels', 'in_date', 'daily_car_list_id', 'daily_cars', 'total_liters', 'total_amount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now();
        $daily_cars = DailyCarList::whereDate('date', $today)->orderBy('sr_no')->get();
        $shops = DieselShop::orderBy('name')->get();
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $diesel_stock = Stock::where('code', '001-001')->first();
        $ref_no = Diesel::generateRefNo($today->format('Ym'));

        return view('diesels.create', compact('daily_cars', 'shops', 'tours', 'cars', 'diesel_stock', 'ref_no', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'out_date' => 'required',
            'in_date' => 'required',
            'purchase_date' => 'required',
            // 'daily_car_list_id' => 'required',
            'tour_id' => 'required',
            'car_id' => 'required',
            'shop_id' => 'required',
            'liter' => 'required',
            'gallon' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'amount' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $ref_no = Diesel::generateRefNo($in_date->format('Ym'));

        $data = Diesel::create([
            'ref_no' => $ref_no,
            'out_date' => Carbon::parse($request->out_date),
            'in_date' => $in_date,
            'purchase_date' => Carbon::parse($request->purchase_date),
            'daily_car_list_id' => $request->daily_car_list_id,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,

            'route_type' => $request->route_type,
            'shop_id' => $request->shop_id,
            'stock_id' => $request->stock_id,

            'liter' => $request->liter,
            'gallon' => $request->gallon,
            'price' => $request->price,
            'discount' => $request->discount,
            'amount' => $request->amount,

            'payment_type' => $request->payment_type,
            'remark' => $request->remark,
            'created_user_id' => Auth::id()
        ]);

        return redirect()->route('diesels.index', [
            // 'out_date' => Carbon::parse($request->out_date)->format('d-m-Y'),
            'in_date' => $in_date->format('d-m-Y'),
            // 'purchase_date' => Carbon::parse($request->purchase_date)->format('d-m-Y'),
            'daily_car_list_id' => $request->daily_car_list_id,
        ]);
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
    public function edit(Diesel $diesel)
    {
        $date = Carbon::parse($diesel->in_date);
        $daily_cars = DailyCarList::whereDate('date', $date)->orderBy('sr_no')->get();
        $shops = DieselShop::orderBy('name')->get();
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $diesel_stock = Stock::where('code', '001-001')->first();

        $diesel->in_date = $date->format('d-m-Y');
        $diesel->out_date = Carbon::parse($diesel->out_date)->format('d-m-Y');
        $diesel->purchase_date = Carbon::parse($diesel->purchase_date)->format('d-m-Y');

        return view('diesels.edit', compact('daily_cars', 'shops', 'tours', 'cars', 'diesel_stock', 'diesel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diesel $diesel)
    {
        $validated = $request->validate([
            'out_date' => 'required',
            'in_date' => 'required',
            'purchase_date' => 'required',
            // 'daily_car_list_id' => 'required',
            'tour_id' => 'required',
            'car_id' => 'required',
            'route_type' => 'required',
            'payment_type' => 'required',
            'shop_id' => 'required',
            'liter' => 'required',
            'gallon' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'amount' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $old_in_date = Carbon::parse($diesel->in_date);

        $ref_no = $diesel->ref_no;

        if ($in_date->month != $old_in_date->month) {
            $ref_no = Diesel::generateRefNo($in_date->format('Ym'));
        }

        $data = $diesel->update([
            'ref_no' => $ref_no,
            'out_date' => Carbon::parse($request->out_date),
            'in_date' => $in_date,
            'purchase_date' => Carbon::parse($request->purchase_date),
            'daily_car_list_id' => $request->daily_car_list_id,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,

            'route_type' => $request->route_type,
            'shop_id' => $request->shop_id,
            'stock_id' => $request->stock_id,

            'liter' => $request->liter,
            'gallon' => $request->gallon,
            'price' => $request->price,
            'discount' => $request->discount,
            'amount' => $request->amount,

            'payment_type' => $request->payment_type,
            'remark' => $request->remark,
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('diesels.index', [
            // 'out_date' => Carbon::parse($request->out_date)->format('d-m-Y'),
            'in_date' => $in_date->format('d-m-Y'),
            // 'purchase_date' => Carbon::parse($request->purchase_date)->format('d-m-Y'),
            'daily_car_list_id' => $request->daily_car_list_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diesel $diesel)
    {
        $diesel->delete();
        return back();
    }

    public function getInDateRelatedInfo(Request $request)
    {
        $in_date = Carbon::parse($request->query('in_date'));
        $refNo = Diesel::generateRefNo($in_date->format('Ym'));
        $daily_cars = DailyCarList::whereDate('date', $in_date->format('Y-m-d'))->orderBy('sr_no')->get();

        return response()->json([
            'ref_no' => $refNo,
            'daily_cars' => $daily_cars,
        ]);
    }
}
