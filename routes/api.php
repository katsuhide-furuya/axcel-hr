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
});

