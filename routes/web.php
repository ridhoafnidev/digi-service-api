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
    return view('layouts/main');
});

Route::resource('teknisi','TeknisiController');
Route::resource('pelanggan','PelangganController');
Route::resource('jenis-hp','JenisHpController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/list-api', 'ApiController@list');
Route::post('/add-api', 'ApiController@add_api');
