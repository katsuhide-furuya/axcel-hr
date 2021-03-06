<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/company/save', 'CompanyController@companySave');
    Route::post('/organization/save', 'CompanyController@organizationSave');
    Route::post('/division/save', 'CompanyController@divisionSave');
    
    Route::post('/member/save', 'UserController@save');
    Route::post('/member/edit', 'UserController@edit');
    Route::post('/member/delete', 'UserController@delete');
    Route::post('/member/rest', 'UserController@rest');

    Route::post('/group/save', 'GroupController@save');
    Route::post('/group/edit', 'GroupController@edit');
    Route::post('/group/delete', 'GroupController@delete');
    Route::post('/group/rest', 'GroupController@rest');

    Route::post('/period/save', 'PeriodController@save');
    Route::post('/period/edit', 'PeriodController@edit');
    Route::post('/period/delete', 'PeriodController@delete');
    Route::post('/period/rest', 'PeriodController@rest');

    Route::post('/sheet/save', 'SheetController@save');
    Route::post('/sheet/edit', 'SheetController@edit');
    Route::post('/sheet/delete', 'SheetController@delete');
    Route::post('/sheet/rest', 'SheetController@rest');

    Route::post('/entity/edit', 'SheetEntityController@edit');
    Route::post('/entity/approve', 'SheetEntityController@edit');
    Route::post('/entity/restrospective', 'SheetEntityController@edit');
    Route::post('/entity/lastEvaluate', 'SheetEntityController@edit');
    Route::post('/entity/raterComment', 'SheetEntityController@edit');

});

