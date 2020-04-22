<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Group;
use App\Models\Period;
use App\Models\Sheet;
use App\Models\SheetEntity;

class SheetController extends Controller
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
     * Show the sheets.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sheets = Sheet::orderBy('id', 'asc')->get();
        $groups = Group::orderBy('id', 'asc')->get();
        $periods = Period::orderBy('id', 'asc')->get();
        return view('manage/sheet', compact('sheets', 'groups', 'periods'));
    }

    /**
     * Create sheet.
     * 
     */
    public function save(Request $request)
    {
        $rules = [
            'periodId'         => 'required|integer',
            'sheetName'        => 'required|max:100',
            'sheetTitle'       => 'required',
            'sheetDescription' => 'required',
            'sheetKind'        => 'required',
            'sheetStyle'       => 'required',
            'sheetGroup'       => 'required',
        ];

        $request->validate($rules);

        $sheet = Sheet::create([
            'period_id'         => $request->periodId,
            'sheet_name'        => $request->sheetName,
            'sheet_title'       => $request->sheetTitle,
            'sheet_description' => $request->sheetDescription,
            'sheet_kind'        => $request->sheetKind,
            'sheet_style'       => $request->sheetStyle,
            'sheet_group'       => $request->sheetGroup,
        ]);

        $objectives = [];
        $objective = [
            'target'              => '',
            'limitAndAchievement' => '',
            'retrospective'       => '',
            'score'               => '',
            'inTarget'            => [
                '0' => [
                    'target'        => '',
                    'status'        => '',
                    'retrospective' => '',
                    'score'         => ''
                ]
            ]
        ];

        // シートのブロック数決め
        for ($i=0; $i < $request->sheetStyle; $i++) { 
            array_push($objectives, $objective);
        }

        // 人数分のシートを作成
        $group = Group::where('id', $request->sheetGroup)->first();
        $evaluatee = json_decode($group->evaluatee, true);
        $rater = json_decode($group->rater, true);
        for ($i=0; $i < count($evaluatee); $i++) { 
            SheetEntity::create([
                'sheet_id'     => $sheet->id,
                'evaluatee_id' => $evaluatee[$i],
                'rater_id'     => $rater[$i],
                'objective'    => json_encode($objectives, JSON_PRETTY_PRINT)
            ]);
        }
    }

    /**
     * Edit sheet.
     * 
     */
    public function edit(Request $request)
    {
        $rules = [
            'periodId'         => 'required|integer',
            'sheetTitle'       => 'required',
            'sheetDescription' => 'required',
            'sheetGroup'       => 'required',
        ];

        $request->validate($rules);

        $sheet = Sheet::where('id', $request->id)->first();
        $sheet->sheet_title       = $request->sheetTitle;
        $sheet->sheet_description = $request->sheetDescription;
        $sheet->sheet_group       = $request->sheetGroup;
        $sheet->save();
    }

    /**
     * Delete sheet.
     * 
     */
    public function delete(Request $request)
    {
        $sheet = Sheet::where('id', $request->id)->first();
        $sheet->del_flg = 1;
        $sheet->save();
    }

    /**
     * Rest sheet.
     * 
     */
    public function rest(Request $request)
    {
        $sheet = Sheet::where('id', $request->id)->first();
        $sheet->del_flg = 0;
        $sheet->save();
    }
}
