<?php

namespace App\Http\Controllers;

use App\Models\Coa;
use App\Models\HomeCarMain;
use App\Models\HomeCarMainCb;
use App\Models\HomeCarMainCbDetail;
use App\Models\SampleHomeCarCb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeCarMainCbController extends Controller
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

        $cbs = HomeCarMainCb::whereHas('main', function ($query) use ($start_date, $end_date) {
            $query->whereBetween('in_date', [$start_date, $end_date]);
        })
            ->orderBy('ref_no', 'desc')
            ->get();

        return view('home-car-main-cbs.index', compact('cbs', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, HomeCarMain $homeCarMain)
    {
        $coas = Coa::orderBy('line_no')->get();
        $ref_no = HomeCarMainCb::generateRefNo(Carbon::parse($homeCarMain->in_date)->format('Ym'));
        $from = $request->from;

        $sampleCb = SampleHomeCarCb::where('tour_id', $homeCarMain->tour_id)->first();
        $sampleCb->total = ($sampleCb->net_amount_debit > $sampleCb->net_amount_credit) ? $sampleCb->net_amount_debit : $sampleCb->net_amount_credit;
        
        return view('home-car-main-cbs.create', compact('coas', 'ref_no', 'homeCarMain', 'from', 'sampleCb'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_id' => 'required',
            'line_no' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $ref_no = HomeCarMainCb::generateRefNo($in_date->format('Ym'));
        $data = HomeCarMainCb::create([
            'ref_no' => $ref_no,
            'main_id' => $request->main_id,
            'total_income' => $request->total_income,
            'total_expense' => $request->total_expense,
            'net_amount_debit' => $request->net_amount_debit,
            'net_amount_credit' => $request->net_amount_credit,
            'created_user_id' => Auth::id()
        ]);

        $details = [];
        for ($i = 0; $i < ($request->max_line_no - 1); $i++) {
            $details[] = HomeCarMainCbDetail::create([
                'cb_id' => $data->id,
                'line_no' => $request->line_no[$i],
                'coa_id' => $request->coa_id[$i],
                'remark' => $request->remark[$i],
                'debit' => $request->debit[$i],
                'credit' => $request->credit[$i],
            ]);
        }

        return redirect()->route('home-car-main-cbs.edit', [$data->id, 'from' => $request->from]);
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
    public function edit(Request $request, HomeCarMainCb $homeCarMainCb)
    {
        $coas = Coa::orderBy('line_no')->get();
        $from = $request->from;

        $homeCarMainCb->main->in_date = Carbon::parse($homeCarMainCb->main->in_date)->format('d-m-Y');
        $homeCarMainCb->main->out_date = Carbon::parse($homeCarMainCb->main->out_date)->format('d-m-Y');
        $homeCarMainCb->total = ($homeCarMainCb->net_amount_debit > $homeCarMainCb->net_amount_credit) ? $homeCarMainCb->net_amount_debit : $homeCarMainCb->net_amount_credit;

        return view('home-car-main-cbs.edit', compact('coas', 'homeCarMainCb', 'from'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeCarMainCb $homeCarMainCb)
    {
        $validated = $request->validate([
            'main_id' => 'required',
            'line_no' => 'required',
        ]);

        $in_date = Carbon::parse($request->in_date);
        $old_in_date = Carbon::parse($homeCarMainCb->main->in_date);

        $ref_no = $homeCarMainCb->ref_no;

        if ($in_date->month != $old_in_date->month) {
            $ref_no = HomeCarMain::generateRefNo($in_date->format('Ym'));
        }

        $homeCarMainCb->update([
            'ref_no' => $ref_no,
            'total_income' => $request->total_income,
            'total_expense' => $request->total_expense,
            'net_amount_debit' => $request->net_amount_debit,
            'net_amount_credit' => $request->net_amount_credit,
            'updated_user_id' => Auth::id()
        ]);

        $homeCarMainCb->details()->delete();

        $details = [];
        for ($i = 0; $i < ($request->max_line_no - 1); $i++) {
            $details[] = HomeCarMainCbDetail::create([
                'cb_id' => $homeCarMainCb->id,
                'line_no' => $request->line_no[$i],
                'coa_id' => $request->coa_id[$i],
                'remark' => $request->remark[$i],
                'debit' => $request->debit[$i],
                'credit' => $request->credit[$i],
            ]);
        }

        return redirect()->route('home-car-main-cbs.edit', [$homeCarMainCb->id, 'from' => $request->from]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeCarMainCb $homeCarMainCb)
    {
        $homeCarMainCb->delete();
        return back();
    }

    public function generateRefNo(Request $request)
    {
        $in_date = Carbon::parse($request->query('in_date'));
        $refNo = HomeCarMainCb::generateRefNo($in_date->format('Ym'));
        return response()->json(['ref_no' => $refNo]);
    }
}
