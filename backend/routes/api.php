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

Route::get('/auth/token', 'App\Http\Controllers\Api\AuthTokenController@index');
Route::post('/users', 'App\Http\Controllers\Api\CreateUserController@index');
Route::get('mylogin','App\Http\Controllers\LoginController@topPage');

Route::get('mylogin','App\Http\Controllers\LoginController@topPage');
Route::post('login','App\Http\Controllers\Api\LoginController@login');

Route::get('/schedules/{id}', 'App\Http\Controllers\Api\ScheduleDetailController@detail');
Route::put('/schedules/{id}', 'App\Http\Controllers\Api\EditScheduleController@update');
Route::delete('/schedules/{id}', 'App\Http\Controllers\Api\DeleteScheduleController@delete');

Route::get('/show-schedules/search-by-day', 'App\Http\Controllers\Api\ShowScheduleController@show_all');

Route::middleware('auth:api')->get('/calendar', 'App\Http\Controllers\Api\CalendarController@calendar');

Route::get('/users/{id}', 'App\Http\Controllers\Api\DetailUserController@detail');

Route::post('/schedules', 'App\Http\Controllers\Api\CreateScheduleController@create');

Route::middleware('auth:api')->delete('logout', 'App\Http\Controllers\Api\LogoutController@logout');

