<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\SampleHomeCarCb;
use App\Models\SampleHomeCarCbDetail;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SampleHomeCarCbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cbs = SampleHomeCarCb::orderBy('tour_id')->get();

        return view('sample-home-car-cbs.index', compact('cbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coas = Coa::orderBy('line_no')->get();
        $tours = Tour::orderBy('short_name')->get();

        return view('sample-home-car-cbs.create', compact('coas', 'tours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => ['required', Rule::unique('sample_home_car_cbs', 'tour_id')],
            'line_no' => 'required',
        ], [
            'tour_id.unique' => 'ယခုခရီးစဉ်နှင့် ထည့်ပြီးသားရှိနေပါသည်။',
        ]);

        $data = SampleHomeCarCb::create([
            'tour_id' => $request->tour_id,
            'total_income' => $request->total_income,
            'total_expense' => $request->total_expense,
            'net_amount_debit' => $request->net_amount_debit,
            'net_amount_credit' => $request->net_amount_credit,
            'created_user_id' => Auth::id()
        ]);

        $details = [];
        for ($i = 0; $i < ($request->max_line_no - 1); $i++) {
            $details[] = SampleHomeCarCbDetail::create([
                'cb_id' => $data->id,
                'line_no' => $request->line_no[$i],
                'coa_id' => $request->coa_id[$i],
                'remark' => $request->remark[$i],
                'debit' => $request->debit[$i],
                'credit' => $request->credit[$i],
            ]);
        }

        return redirect()->route('sample-home-car-cbs.index');
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
    public function edit(SampleHomeCarCb $sampleHomeCarCb)
    {
        $coas = Coa::orderBy('line_no')->get();
        $tours = Tour::orderBy('short_name')->get();

        return view('sample-home-car-cbs.edit', compact('coas', 'sampleHomeCarCb', 'tours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SampleHomeCarCb $sampleHomeCarCb)
    {
        $validated = $request->validate([
            'tour_id' => [
                'required',
                Rule::unique('sample_home_car_cbs', 'tour_id')->ignore($sampleHomeCarCb->tour_id),
            ],
            'line_no' => 'required',
        ], [
            'tour_id.unique' => 'ယခုခရီးစဉ်နှင့် ထည့်ပြီးသားရှိနေပါသည်။',
        ]);

        $sampleHomeCarCb->update([
            'tour_id' => $request->tour_id,
            'total_income' => $request->total_income,
            'total_expense' => $request->total_expense,
            'net_amount_debit' => $request->net_amount_debit,
            'net_amount_credit' => $request->net_amount_credit,
            'updated_user_id' => Auth::id()
        ]);

        $sampleHomeCarCb->details()->delete();

        $details = [];
        for ($i = 0; $i < ($request->max_line_no - 1); $i++) {
            $details[] = SampleHomeCarCbDetail::create([
                'cb_id' => $sampleHomeCarCb->id,
                'line_no' => $request->line_no[$i],
                'coa_id' => $request->coa_id[$i],
                'remark' => $request->remark[$i],
                'debit' => $request->debit[$i],
                'credit' => $request->credit[$i],
            ]);
        }

        return redirect()->route('sample-home-car-cbs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SampleHomeCarCb $sampleHomeCarCb)
    {
        $sampleHomeCarCb->delete();
        return back();
    }
}
