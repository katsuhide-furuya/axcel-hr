<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class CompanyController extends Controller
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
     * Show the company info.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyInfo = CompanyInfo::where('key', 'company')->get();
        if ($companyInfo->isNotEmpty()) $companyInfo = $companyInfo->first()->value;

        $jobCategory = CompanyInfo::where('key', 'job_category')->get();
        if ($jobCategory->isNotEmpty()) $jobCategory = $jobCategory->first()->value;
        
        $posts = CompanyInfo::where('key', 'post')->get();
        if ($posts->isNotEmpty()) $posts = $posts->first()->value;
        
        $recruitType = CompanyInfo::where('key', 'recruit')->get();
        if ($recruitType->isNotEmpty()) $recruitType = $recruitType->first()->value;
        
        $empStatus = CompanyInfo::where('key', 'employment_status')->get();
        if ($empStatus->isNotEmpty()) $empStatus = $empStatus->first()->value;
        
        $divisions = CompanyInfo::where('key', 'division')->get();
        if ($divisions->isNotEmpty()) $divisions = $divisions->first()->value;

        return view('company', compact('companyInfo', 'jobCategory', 'posts', 'recruitType', 'empStatus', 'divisions'));
    }

    /**
     * Save or Update company info.
     * 
     */
    public function companySave(Request $request)
    {
        $rules = [
            'companyName'     => 'required|max:100',
            'companyTel'      => 'required|regex:/\d{10,11}/',
            'companyMail'     => 'required|email:rfc,dns',
            'companyZipcode'  => 'required|regex:/\d{7}/',
            'companyState'    => 'required',
            'companyCity'     => 'required|max:100',
            'companyAddress1' => 'required|max:100',
            'companyAddress2' => 'required|max:100'
        ];

        $request->validate($rules);

        $companyInfo = CompanyInfo::where('key', 'company')->get();
        if ($companyInfo->isEmpty()) {
            $companyInfo = new CompanyInfo;
        } else {
            $companyInfo = $companyInfo->first();
        }

        $info = array(
            'companyName'     => $request->companyName,
            'companyTel'      => $request->companyTel,
            'companyMail'     => $request->companyMail,
            'companyZipcode'  => $request->companyZipcode,
            'companyState'    => $request->companyState,
            'companyCity'     => $request->companyCity,
            'companyAddress1' => $request->companyAddress1,
            'companyAddress2' => $request->companyAddress2,
        );

        $companyInfo->key   = 'company';
        $companyInfo->value = json_encode($info, JSON_PRETTY_PRINT);
        $companyInfo->save();
    }

    /**
     * Save or Update organization info.
     * 
     */
    public function organizationSave(Request $request)
    {
        $jobCategory = CompanyInfo::where('key', 'job_category')->get();
        if ($jobCategory->isEmpty()) {
            $jobCategory = new CompanyInfo;
        } else {
            $jobCategory = $jobCategory->first();
        }

        $posts = CompanyInfo::where('key', 'post')->get();
        if ($posts->isEmpty()) {
            $posts = new CompanyInfo;
        } else {
            $posts = $posts->first();
        }

        $recruitType = CompanyInfo::where('key', 'recruit')->get();
        if ($recruitType->isEmpty()) {
            $recruitType = new CompanyInfo;
        } else {
            $recruitType = $recruitType->first();
        }

        $employmentStatus = CompanyInfo::where('key', 'employment_status')->get();
        if ($employmentStatus->isEmpty()) {
            $employmentStatus = new CompanyInfo;
        } else {
            $employmentStatus = $employmentStatus->first();
        }

        $job = $request->jobCategoryName;
        $jobCategory->key = 'job_category';
        $jobCategory->value = json_encode($job, JSON_PRETTY_PRINT);
        $jobCategory->save();

        $post = $request->postName;
        $posts->key = 'post';
        $posts->value = json_encode($post, JSON_PRETTY_PRINT);
        $posts->save();

        $recruit = $request->recruitTypeName;
        $recruitType->key = 'recruit';
        $recruitType->value = json_encode($recruit, JSON_PRETTY_PRINT);
        $recruitType->save();

        $empStat = $request->empStatusName;
        $employmentStatus->key = 'employment_status';
        $employmentStatus->value = json_encode($empStat, JSON_PRETTY_PRINT);
        $employmentStatus->save();
    }

    /**
     * Save or Update division info.
     * 
     */
    public function divisionSave(Request $request)
    {
        $divisions = CompanyInfo::where('key', 'division')->get();

        if ($divisions->isEmpty()) {
            $divisions = new CompanyInfo;
        } else {
            $divisions = $divisions->first();
        }

        $division = $request->divisionName;
        $divisions->key = 'division';
        $divisions->value = json_encode($division, JSON_PRETTY_PRINT);
        $divisions->save();
    }
}
