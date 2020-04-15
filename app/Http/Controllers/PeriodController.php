<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;

class PeriodController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the periods.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $periods = Period::orderBy('id', 'asc')->get();
        return view('manage/period', compact('periods'));
    }

    /**
     * Create group.
     * 
     */
    public function save(Request $request)
    {
        $rules = [
            'periodName' => 'required|max:100',
            'startDate'  => 'required|date',
            'endDate'    => 'required|date',
            'status'     => 'required',
        ];

        $request->validate($rules);

        Period::create([
            'period_name' => $request->periodName,
            'start_date'  => $request->startDate,
            'end_date'    => $request->endDate,
            'status'      => $request->status,
        ]);
    }

    /**
     * Edit period.
     * 
     */
    public function edit(Request $request)
    {
        $rules = [
            'periodName' => 'required|max:100',
            'startDate'  => 'required|date',
            'endDate'    => 'required|date',
            'status'     => 'required',
        ];

        $request->validate($rules);
        
        $period = Period::where('id', $request->id)->first();
        $period->period_name = $request->periodName;
        $period->start_date  = $request->startDate;
        $period->end_date    = $request->endDate;
        $period->status      = $request->status;
        $period->save();
    }

    /**
     * Delete period.
     * 
     */
    public function delete(Request $request)
    {
        $period = Period::where('id', $request->id)->first();
        $period->del_flg = 1;
        $period->save();
    }

    /**
     * Rest period.
     * 
     */
    public function rest(Request $request)
    {
        $period = Period::where('id', $request->id)->first();
        $period->del_flg = 0;
        $period->save();
    }
}
