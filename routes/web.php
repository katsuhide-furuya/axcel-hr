<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/members', 'UserController@index');

Route::get('/company', 'CompanyController@index');

Route::get('/periods', 'PeriodController@index');

Route::get('/groups', 'GroupController@index');

Route::get('/sheets', 'SheetController@index');

Route::get('/entity/{id}', 'SheetEntityController@index');

Route::get('/overview', 'OverviewController@index');

Route::get('/objectives', 'ObjectiveController@index');
