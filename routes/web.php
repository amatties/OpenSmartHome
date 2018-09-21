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

Route::resource('/light', 'LightController');
Route::resource('/lock', 'LockController');
Route::resource('/device', 'DeviceController');
Route::resource('/module', 'ModuleController');
Route::get('command/{port}/{port_status}/{id}/{pub_topic}','LightController@command')->name('command.msg');