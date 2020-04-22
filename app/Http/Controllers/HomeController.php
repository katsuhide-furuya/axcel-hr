<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Period;
use App\Models\Sheet;
use App\Models\SheetEntity;
use App\Models\UserInfo;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $entities = SheetEntity::with('sheet', 'evaluatee', 'rater')->where('evaluatee_id', Auth::id())->orWhere('rater_id', Auth::id())->orderBy('id', 'asc')->get();
        $otherEntities = SheetEntity::with('sheet', 'evaluatee', 'rater')->where('evaluatee_id', '!=', Auth::id())->orderBy('id', 'asc')->get();
        $periods = Period::orderBy('id', 'asc')->get();
        return view('home', compact('entities', 'otherEntities', 'periods'));
    }
}
