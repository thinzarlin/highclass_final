<?php

namespace App\Http\Controllers;

use App\Models\CbRecord;
use App\Models\Coa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CbRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();

        $date = Carbon::now();
        if ($request->has(['date'])) {
            $date = Carbon::parse($request->date);
        }
        $ref_no = CbRecord::generateRefNo($date->format('Ym'));
        $line_no = CbRecord::generateLineNo($date->format('Y-m-d'));

        $cb = null;
        if ($request->has(['id'])) {
            $cb = CbRecord::find($request->id);
            $date = Carbon::parse($cb->date);
            $ref_no = $cb->ref_no;
            $line_no = $cb->line_no;
        }

        $cbs = CbRecord::where('date', $date->format('Y-m-d'))
            ->orderBy('ref_no')
            ->get();

        $coas = Coa::orderBy('line_no')->get();

        // dd($coas[0]->accountType->name);

        return view('cb-records.index', compact('cbs', 'cb', 'date', 'coas', 'ref_no', 'line_no'));
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
            'date' => 'required',
            'coa_id' => 'required',
            'debit' => 'required',
            'credit' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $ref_no = CbRecord::generateRefNo($date->format('Ym'));
        $line_no = CbRecord::generateLineNo($date->format('Y-m-d'));
        $data = CbRecord::create([
            'ref_no' => $ref_no,
            'date' => $date,
            'line_no' => $line_no,
            'coa_id' => $request->coa_id,
            'remark' => $request->remark,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'created_user_id' => Auth::id()
        ]);

        return redirect()->route('cb-records.index', [
            'date' => $date->format('d-m-Y'),
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CbRecord $cbRecord)
    {
        $validated = $request->validate([
            'date' => 'required',
            'coa_id' => 'required',
            'debit' => 'required',
            'credit' => 'required',
        ]);

        $date = Carbon::parse($request->date);
        $old_date = Carbon::parse($cbRecord->date);

        $ref_no = $cbRecord->ref_no;
        $line_no = $cbRecord->line_no;

        if ($date->month != $old_date->month) {
            $ref_no = CbRecord::generateRefNo($date->format('Ym'));
        }

        if ($date != $old_date) {
            $line_no = CbRecord::generateLineNo($date->format('Y-m-d'));
        }

        $cbRecord->update([
            'ref_no' => $ref_no,
            'date' => $date,
            'line_no' => $line_no,
            'coa_id' => $request->coa_id,
            'remark' => $request->remark,
            'debit' => $request->debit,
            'credit' => $request->credit,
            'updated_user_id' => Auth::id()
        ]);

        return redirect()->route('cb-records.index', [
            'date' => $date->format('d-m-Y'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CbRecord $cbRecord)
    {
        $cbRecord->delete();
        return back();
    }

    public function getDateRelatedInfo(Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        $old_date = Carbon::parse($request->query('old_date'));
        $line_no = CbRecord::generateLineNo($date->format('Y-m-d'));

        if ($date->month != $old_date?->month) {
            $ref_no = CbRecord::generateRefNo($date->format('Ym'));
            
            return response()->json([
                'ref_no' => $ref_no,
                'line_no' => $line_no
            ]);
        }

        return response()->json([
            'ref_no' => $request->query('old_ref_no'),
            'line_no' => $line_no
        ]);
    }
}
