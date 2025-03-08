<?php

namespace App\Http\Controllers;

use App\Imports\CargoImport;
use App\Models\Car;
use App\Models\Cargo;
use App\Models\City;
use App\Models\Gate;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CargoController extends Controller
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

        $cargos = Cargo::whereBetween('date', [$start_date, $end_date])
            ->orderBy('ref_no', 'desc')
            ->get();

        return view('cargos.index', compact('cargos', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now();
        $ref_no = Cargo::generateRefNo($today->format('Ym'));
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $cities = City::orderBy('mm_name')->get();
        $ygn_gates = City::find(1)->gates;

        return view('cargos.create', compact('ref_no', 'today', 'tours', 'cars', 'cities', 'ygn_gates'));
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
            'cargo_no' => 'required',
            'from_city_id' => 'required',
            'from_gate_id' => 'required',
            'to_city_id' => 'required',
            'to_gate_id' => 'required',
            'sender_name' => 'required',
            'receiver_name' => 'required',
            'item_name' => 'required',
            'qty' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $ref_no = Cargo::generateRefNo($date->format('Ym'));

        $data = Cargo::create([
            'ref_no' => $ref_no,
            'date' => $date,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,
            'cargo_no' => $request->cargo_no,
            'from_city_id' => $request->from_city_id,
            'from_gate_id' => $request->from_gate_id,
            'to_city_id' => $request->to_city_id,
            'to_gate_id' => $request->to_gate_id,
            'sender_name' => $request->sender_name,
            'sender_phone' => $request->sender_phone,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'item_name' => $request->item_name,
            'qty' => $request->qty,
            'cargo_amt' => $request->cargo_amt ?? 0,
            'khauk_to' => $request->khauk_to ?? 0,
            'deli' => $request->deli ?? 0,
            'site_shin' => $request->site_shin ?? 0,
            'site_shin_prev_car' => 0,
            'bawdar_fee' => $request->bawdar_fee ?? 0,
            'total' => $request->total ?? 0,

            'remark' => $request->remark,
            'created_user_id' => Auth::id()
        ]);

        return redirect()->route('cargos.index');
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
    public function edit(Cargo $cargo)
    {
        $tours = Tour::orderBy('short_name')->get();
        $cars = Car::orderBy('car_no')->get();
        $cities = City::orderBy('mm_name')->get();
        $from_gates = City::find($cargo->from_city_id)->gates;
        $to_gates = City::find($cargo->to_city_id)->gates;

        $cargo->date = Carbon::parse($cargo->date)->format('d-m-Y');

        return view('cargos.edit', compact('cargo', 'tours', 'cars', 'cities', 'from_gates', 'to_gates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cargo $cargo)
    {
        $validated = $request->validate([
            'date' => 'required',
            'tour_id' => 'required',
            'car_id' => 'required',
            'cargo_no' => 'required',
            'from_city_id' => 'required',
            'from_gate_id' => 'required',
            'to_city_id' => 'required',
            'to_gate_id' => 'required',
            'sender_name' => 'required',
            'receiver_name' => 'required',
            'item_name' => 'required',
            'qty' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $old_date = Carbon::parse($cargo->date);

        $ref_no = $cargo->ref_no;

        if ($date->month != $old_date->month) {
            $ref_no = Cargo::generateRefNo($date->format('Ym'));
        }

        $data = $cargo->update([
            'ref_no' => $ref_no,
            'date' => $date,
            'tour_id' => $request->tour_id,
            'car_id' => $request->car_id,
            'cargo_no' => $request->cargo_no,
            'from_city_id' => $request->from_city_id,
            'from_gate_id' => $request->from_gate_id,
            'to_city_id' => $request->to_city_id,
            'to_gate_id' => $request->to_gate_id,
            'sender_name' => $request->sender_name,
            'sender_phone' => $request->sender_phone,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'item_name' => $request->item_name,
            'qty' => $request->qty,
            'cargo_amt' => $request->cargo_amt ?? 0,
            'khauk_to' => $request->khauk_to ?? 0,
            'deli' => $request->deli ?? 0,
            'site_shin' => $request->site_shin ?? 0,
            'site_shin_prev_car' => 0,
            'bawdar_fee' => $request->bawdar_fee ?? 0,
            'total' => $request->total ?? 0,

            'remark' => $request->remark,
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('cargos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cargo $cargo)
    {
        $cargo->delete();
        return back()->with('success', 'Record deleted successfully.');
    }

    public function getDateRelatedInfo(Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        $old_date = Carbon::parse($request->query('old_date'));

        if ($date->month != $old_date?->month) {
            $ref_no = Cargo::generateRefNo($date->format('Ym'));
            
            return response()->json([
                'ref_no' => $ref_no,
            ]);
        }

        return response()->json([
            'ref_no' => $request->query('old_ref_no'),
        ]);
    }

    public function getGatesByCity(Request $request)
    {
        $city_id = $request->query('city_id');
        $gates = City::find($city_id)->gates;

        return response()->json([
            'gates' => $gates,
        ]);
    }

    public function importExcel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new CargoImport, $request->file('file'));

        return redirect()->route('cargos.index')->with('success', 'Excel file imported successfully!');
    }
}
