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


Route::resource('/sensor', 'Api\SensorController');
Route::resource('/light', 'Api\LightController');
Route::resource('/device', 'Api\DeviceController');
Route::resource('/lock', 'Api\LockController');
Route::get('/login/{user}/{pass}', 'Api\loginController@login');
Route::post('/open','Api\LockController@open');
Route::get('/graph','Api\LightController@teste');
Route::post('/acommand','Api\LightController@command');
Route::post('/receive','LockController@receiveData');
Route::post('/sensor','SensorController@receiveData');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
