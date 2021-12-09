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

// Authentication Routes..
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('layouts/main');
});

Route::resource('teknisi','TeknisiController');
//Route::get('/sertifikat/{id}', 'TeknisiController@lihatSertifikat');
Route::resource('pelanggan','PelangganController');
Route::resource('jenis-hp','JenisHpController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/beranda', 'BerandaController@index')->name('index');

Route::get('/list-api', 'ApiController@list');
Route::post('/add-api', 'ApiController@add_api');
