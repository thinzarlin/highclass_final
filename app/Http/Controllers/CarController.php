<?php

namespace App\Http\Controllers;

use App\Enums\CarStaffType;
use App\Models\Car;
use App\Models\CarStaff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::orderBy('car_no')->get();
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $driver_1s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver1)->orderBy('name')->get();
        $driver_2s = CarStaff::where('current', 1)->where('type', CarStaffType::Driver2)->orderBy('name')->get();
        $spares = CarStaff::where('current', 1)->where('type', CarStaffType::Spare)->orderBy('name')->get();
        $crews = CarStaff::where('current', 1)->where('type', CarStaffType::Crew)->orderBy('name')->get();
        $car_staff_types = CarStaffType::cases();
        
        return view('cars.create', compact('driver_1s', 'driver_2s', 'spares', 'crews', 'car_staff_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_no' => 'required|string|max:255',
        ]);
        
        $data = Car::create([
            'car_no' => $request->car_no,
            'owner' => $request->owner,
            'driver_1_id' => $request->driver_1_id,
            'driver_2_id' => $request->driver_2_id,
            'spare_id' => $request->spare_id,
            'crew_id' => $request->crew_id,
            'type' => $request->type,
            'type_detail' => $request->type_detail,
            'people' => $request->people,
            'current' => $request->current,
            'home_car' => $request->home_car,
            'sold' => $request->sold,

            'created_user_id' => Auth::id()
        ]);

        return redirect()->route('cars.index');
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
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        return view('cars.create', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'car_no' => 'required|string|max:255',
            'owner' => 'string|max:255',
        ]);

        $car = Car::findOrFail($id);
        $car->update([
            'car_no' => $validated['car_no'],
            'owner' => $validated['owner'],
            'people' => $validated['people'],
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
