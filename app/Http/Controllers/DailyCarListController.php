<?php

namespace App\Http\Controllers;

use App\Enums\CarStaffType;
use App\Models\Car;
use App\Models\CarStaff;
use App\Models\DailyCarList;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyCarListController extends Controller
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

        $daily_cars = DailyCarList::whereBetween('date', [$start_date, $end_date])
            ->orderBy('ref_no', 'desc')
            ->get();

        return view('daily-car-lists.index', compact('daily_cars', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now();
        $ref_no = DailyCarList::generateRefNo($today->format('Ym'));
        $sr_no = DailyCarList::generateSrNo($today->format('Y-m-d'));
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $driver_1s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver1)->orderBy('name')->get();
        $driver_2s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver2)->orderBy('name')->get();
        $spares = CarStaff::where('current', 1)->where('type', CarStaffType::Spare)->orderBy('name')->get();
        $crews = CarStaff::where('current', 1)->where('type', CarStaffType::Crew)->orderBy('name')->get();

        return view('daily-car-lists.create', compact('ref_no', 'sr_no', 'today', 'tours', 'cars', 'driver_1s', 'driver_2s', 'spares', 'crews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
            'tour_id' => 'required',
            'car_id' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $ref_no = DailyCarList::generateRefNo($date->format('Ym'));
        $sr_no = DailyCarList::generateSrNo($date->format('Y-m-d'));

        $data = DailyCarList::create([
            'ref_no' => $ref_no,
            'date' => $date,
            'sr_no' => $sr_no,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,
            'driver_1_id' => $request->driver_1_id,
            'driver_2_id' => $request->driver_2_id,
            'spare_id' => $request->spare_id,
            'crew_id' => $request->crew_id,

            'created_user_id' => Auth::id()
        ]);

        return redirect()->route('daily-car-lists.index');
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
    public function edit(DailyCarList $dailyCarList)
    {
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $driver_1s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver1)->orderBy('name')->get();
        $driver_2s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver2)->orderBy('name')->get();
        $spares = CarStaff::where('current', 1)->where('type', CarStaffType::Spare)->orderBy('name')->get();
        $crews = CarStaff::where('current', 1)->where('type', CarStaffType::Crew)->orderBy('name')->get();

        $dailyCarList->date = Carbon::parse($dailyCarList->date)->format('d-m-Y');

        return view('daily-car-lists.edit', compact('dailyCarList', 'tours', 'cars', 'driver_1s', 'driver_2s', 'spares', 'crews'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DailyCarList $dailyCarList)
    {
        $validated = $request->validate([
            'date' => 'required',
            'tour_id' => 'required',
            'car_id' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $old_date = Carbon::parse($dailyCarList->date);
        $old_tour_id = $dailyCarList->tour_id;
        $old_car_id = $dailyCarList->car_id;

        $ref_no = $dailyCarList->ref_no;
        $sr_no = $dailyCarList->sr_no;

        if ($date->month != $old_date->month) {
            $ref_no = DailyCarList::generateRefNo($date->format('Ym'));
            $sr_no = DailyCarList::generateSrNo($date->format('Y-m-d'));
        }

        if ($old_car_id != $request->car_id) {
            if ($dailyCarList->main()->exists()) {
                $dailyCarList->main->car_id = $request->car_id;
            }
            if ($dailyCarList->diesel()->exists()) {
                $dailyCarList->diesel->car_id = $request->car_id;
            }
        }

        if ($old_tour_id != $request->tour_id) {
            if ($dailyCarList->main()->exists()) {
                $dailyCarList->main->tour_id = $request->tour_id;
            }
            if ($dailyCarList->diesel()->exists()) {
                $dailyCarList->diesel->tour_id = $request->tour_id;
            }
        }

        $data = $dailyCarList->update([
            'ref_no' => $ref_no,
            'date' => $date,
            'sr_no' => $sr_no,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,
            'driver_1_id' => $request->driver_1_id,
            'driver_2_id' => $request->driver_2_id,
            'spare_id' => $request->spare_id,
            'crew_id' => $request->crew_id,

            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('daily-car-lists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyCarList $dailyCarList)
    {
        if ($dailyCarList->main()->exists() || $dailyCarList->diesel()->exists()) {
            return back()->with('error', 'Cannot delete this record because it has related data.');
        }

        $dailyCarList->delete();
        return back()->with('success', 'Record deleted successfully.');
    }

    public function getDateRelatedInfo(Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        $old_date = Carbon::parse($request->query('old_date'));
        $sr_no = DailyCarList::generateSrNo($date->format('Y-m-d'));

        if ($date->month != $old_date?->month) {
            $ref_no = DailyCarList::generateRefNo($date->format('Ym'));

            return response()->json([
                'ref_no' => $ref_no,
                'sr_no' => $sr_no
            ]);
        }

        return response()->json([
            'ref_no' => $request->query('old_ref_no'),
            'sr_no' => $sr_no
        ]);
    }
}
