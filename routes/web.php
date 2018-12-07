<?php

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



Auth::routes();

Route::get('/', 'HomeController@index')->name('index')->middleware('auth');
Route::resource('/users', 'Auth\RegisterController')->middleware('auth');
Route::get('rfid/{id}/{user}','Auth\RegisterController@addRfid')->name('rfid.add')->middleware('auth');

Route::resource('/light', 'LightController')->middleware('auth');
Route::resource('/lock', 'LockController')->middleware('auth');
Route::get('lockSelect/{id}','LockController@select')->name('lock.select')->middleware('auth');
Route::resource('/sensor', 'SensorController')->middleware('auth');
Route::post('sensor/{id}','SensorController@show_graph_filter')->name('graph.filter')->middleware('auth');

Route::resource('/schedule', 'ScheduleController')->middleware('auth');
Route::get('schedulel/{id}', 'ScheduleController@novo')->name('schedule.l')->middleware('auth');

Route::resource('/device', 'DeviceController')->middleware('auth');
Route::resource('/log', 'logController')->middleware('auth');
Route::resource('/module', 'ModuleController')->middleware('auth');
Route::get('command/{port}/{port_status}/{id}','LightController@command')->name('command.msg')->middleware('auth');
Route::get('open/{id}','LockController@openWeb')->name('open.msg')->middleware('auth');