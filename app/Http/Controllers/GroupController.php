<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Group;
use App\Models\UserInfo;

class GroupController extends Controller
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
     * Show the groups.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groups = Group::orderBy('id', 'asc')->get();
        $users = UserInfo::all();
        return view('manage/group', compact('groups', 'users'));
    }

    /**
     * Create group.
     * 
     */
    public function save(Request $request)
    {
        $rules = [
            'groupName'      => 'required|max:100',
            'evaluatee'      => 'required',
            'evaluateeCount' => 'required',
            'rater'          => 'required',
            'raterCount'     => 'required'
        ];

        $request->validate($rules);

        Group::create([
            'group_name'      => $request->groupName,
            'evaluatee'       => json_encode($request->evaluatee, JSON_PRETTY_PRINT),
            'evaluatee_count' => $request->evaluateeCount,
            'rater'           => json_encode($request->rater, JSON_PRETTY_PRINT),
            'rater_count'     => $request->raterCount,
        ]);
    }

    /**
     * Edit group.
     * 
     */
    public function edit(Request $request)
    {
        $rules = [
            'groupName'      => 'required|max:100',
            'evaluatee'      => 'required',
            'evaluateeCount' => 'required',
            'rater'          => 'required',
            'raterCount'     => 'required'
        ];

        Log::debug($request);

        $request->validate($rules);

        $group = Group::where('id', $request->id)->first();
        $group->group_name      = $request->groupName;
        $group->evaluatee       = json_encode($request->evaluatee, JSON_PRETTY_PRINT);
        $group->evaluatee_count = $request->evaluateeCount;
        $group->rater           = json_encode($request->rater, JSON_PRETTY_PRINT);
        $group->rater_count     = $request->raterCount;
        $group->save();
    }

    /**
     * Delete group.
     * 
     */
    public function delete(Request $request)
    {
        $group = Group::where('id', $request->id)->first();
        $group->del_flg = 1;
        $group->save();
    }

    /**
     * Rest group.
     * 
     */
    public function rest(Request $request)
    {
        $group = Group::where('id', $request->id)->first();
        $group->del_flg = 0;
        $group->save();
    }
}
