<?php

use Illuminate\Http\Request;

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



Route::resource('/light', 'Api\LightController');
Route::resource('/lock', 'Api\LockController');
Route::post('/acommand','Api\LightController@command');
Route::post('/receive','LockController@receiveData');
Route::post('/sensor','SensorController@receiveData');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
