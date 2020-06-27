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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'  =>  'admin'], function(){
    Route::get('/dashboard','AdminDashboardController@index')->name('admin.dashboard');
});

Route::group(['prefix'  =>  'admin/pengajuans'], function(){
    Route::get('/','AdminPengajuanController@index')->name('admin.pengajuans');
});