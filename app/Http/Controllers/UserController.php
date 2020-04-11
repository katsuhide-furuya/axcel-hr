<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\User;
use App\UserInfo;
use App\CompanyInfo;

class UserController extends Controller
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
     * Show the users.
     * 
     */
    public function index()
    {
        $users = UserInfo::all();

        $jobCategories = CompanyInfo::where('key', 'job_category')->get();
        if ($jobCategories->isNotEmpty()) $jobCategories = $jobCategories->first()->value;
        
        $posts = CompanyInfo::where('key', 'post')->get();
        if ($posts->isNotEmpty()) $posts = $posts->first()->value;
        
        $recruitType = CompanyInfo::where('key', 'recruit')->get();
        if ($recruitType->isNotEmpty()) $recruitType = $recruitType->first()->value;
        
        $empStatus = CompanyInfo::where('key', 'employment_status')->get();
        if ($empStatus->isNotEmpty()) $empStatus = $empStatus->first()->value;
        
        $divisions = CompanyInfo::where('key', 'division')->get();
        if ($divisions->isNotEmpty()) $divisions = $divisions->first()->value;

        return view('member', compact('users', 'jobCategories', 'posts', 'recruitType', 'empStatus', 'divisions'));
    }

    /**
     * Create user info.
     * 
     */
    public function save(Request $request)
    {
        $rules = [
            'name'      => 'required|max:100',
            'email'     => 'required|email:rfc,dns',
            'joiningAt' => 'date'
        ];

        Log::debug($request);
        $request->validate($rules);


        // TODO: 初回ログイン時のパスワード設定, ログインしたらパスワード変えてね的なアレ
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('aaaa1111'),
            'api_token' => Str::random(80),
        ]);

        UserInfo::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'employee_no'      => $request->employeeNo,
            'division'         => $request->division,
            'job_category'     => $request->jobCategory,
            'post'             => $request->post,
            'recruit_category' => $request->recruitCategory,
            'employment_status'=> $request->employmentStatus,
            'joining_at'       => $request->joiningAt,
        ]);
    }
}
