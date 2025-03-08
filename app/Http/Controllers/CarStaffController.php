<?php

namespace App\Http\Controllers;

use App\Enums\CarStaffType;
use App\Models\CarStaff;
use Illuminate\Http\Request;

class CarStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', array_column(CarStaffType::cases(), 'value')),
        ]);

        $carStaff = new CarStaff();
        $carStaff->name = $validated['name'];
        $carStaff->type = $validated['type'];
        $carStaff->current = $request->has('current') ? 1 : 0;
        $carStaff->save();

        return response()->json(['message' => 'Staff created successfully!'], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
