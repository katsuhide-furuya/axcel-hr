<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SheetEntity;

class OverviewController extends Controller
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
     * Show the entities.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $entity = SheetEntity::where('evaluatee_id', Auth::id())->get();
        return view('overview/overview', compact('entity'));
    }
}
