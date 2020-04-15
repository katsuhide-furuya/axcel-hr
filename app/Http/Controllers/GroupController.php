<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'groupName'       => 'required|max:100',
            'evaluators'      => 'required',
            'evaluatorsCount' => 'required',
            'valuators'       => 'required',
            'valuatorsCount'  => 'required'
        ];

        $request->validate($rules);

        Group::create([
            'group_name'       => $request->groupName,
            'evaluators'       => json_encode($request->evaluators, JSON_PRETTY_PRINT),
            'evaluators_count' => $request->evaluatorsCount,
            'valuators'        => json_encode($request->valuators, JSON_PRETTY_PRINT),
            'valuators_count'  => $request->valuatorsCount,
        ]);
    }

    /**
     * Edit group.
     * 
     */
    public function edit(Request $request)
    {
        $rules = [
            'groupName'       => 'required|max:100',
            'evaluators'      => 'required',
            'evaluatorsCount' => 'required',
            'valuators'       => 'required',
            'valuatorsCount'  => 'required'
        ];

        $request->validate($rules);

        $group = Group::where('id', $request->id)->first();
        $group->group_name       = $request->name;
        $group->evaluators       = $request->division;
        $group->evaluators_count = $request->jobCategory;
        $group->valuators        = $request->post;
        $group->valuators_count  = $request->recruitCategory;
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
