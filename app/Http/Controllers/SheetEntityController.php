<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\SheetEntity;

class SheetEntityController extends Controller
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
    public function index($id)
    {
        $entity = SheetEntity::with('sheet', 'evaluatee', 'rater')->where('id', $id)->first();
        return view('entity/entity', compact('entity'));
    }

    /**
     * Edit entity.
     * 
     */
    public function edit(Request $request)
    {
        $entity = SheetEntity::where('id', $request->id)->first();
        $entity->objective = json_encode($request->objectives, JSON_PRETTY_PRINT);
        $entity->status = $request->status;

        if ($request->totalProgress) {
            $entity->total_progress = $request->totalProgress;
        }

        if ($request->totalScore) {
            $entity->total_score = $request->totalScore;
        }
        $entity->save();

        // 被評価者・評価者にメール
    }
}
