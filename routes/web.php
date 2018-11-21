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


Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('index');
Route::resource('/users', 'Auth\RegisterController');
Route::get('rfid/{id}/{user}','Auth\RegisterController@addRfid')->name('rfid.add');

Route::resource('/light', 'LightController');
Route::resource('/lock', 'LockController');
Route::get('lockSelect/{id}','LockController@select')->name('lock.select');
Route::resource('/sensor', 'SensorController');
Route::post('sensor/{id}','SensorController@show_graph_filter')->name('graph.filter');

Route::resource('/schedule', 'ScheduleController');


Route::resource('/device', 'DeviceController');
Route::resource('/module', 'ModuleController');
Route::get('command/{port}/{port_status}/{id}/{sub_topic}','LightController@command')->name('command.msg');
Route::get('open/{id}','LockController@openWeb')->name('open.msg');