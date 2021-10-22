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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Teknisi
Route::get('/teknisi-all', 'Api\TeknisiApi@teknisi_all');
Route::get('/teknisi-insert', 'Api\TeknisiApi@insert_teknisi');
Route::get('/teknisi-update/{id}', 'Api\TeknisiApi@update_teknisi');
Route::get('/teknisi-delete/{id}', 'Api\TeknisiApi@delete_teknisi');
Route::get('/teknisi-by/{reference}/{value}', 'Api\TeknisiApi@teknisi_by');
Route::get('/teknisi-one/{reference}/{value}', 'Api\TeknisiApi@teknisi_one_by');

//Pelanggan
Route::get('/pelanggan-all', 'Api\PelangganApi@pelanggan_all');
Route::get('/pelanggan-insert', 'Api\PelangganApi@insert_pelanggan');
Route::get('/pelanggan-update/{id}', 'Api\PelangganApi@update_pelanggan');
Route::get('/pelanggan-delete/{id}', 'Api\PelangganApi@delete_pelanggan');
Route::get('/pelanggan-by/{reference}/{value}', 'Api\PelangganApi@pelanggan_by');
Route::get('/pelanggan-one/{reference}/{value}', 'Api\PelangganApi@pelanggan_one_by');

// Jenis HP
Route::get('/jenis-hp-all', 'Api\JenisHpApi@jenis_hp_all');
Route::get('/jenis-hp-by/{reference}/{value}', 'Api\JenisHpApi@jenis_hp_by');
Route::get('/jenis-hp-one/{reference}/{value}', 'Api\JenisHpApi@jenis_hp_one_by');
Route::post('/jenis-hp-insert', 'Api\JenisHpApi@insert_jenis_hp');
Route::put('/jenis-hp-update/{id}', 'Api\JenisHpApi@update_jenis_hp');
Route::put('/jenis-hp-delete/{id}', 'Api\JenisHpApi@delete_jenis_hp');


Route::get('/user-all/{token}', 'ApiController@user_all');
Route::get('/user-one/{token}/{reference}/{value}', 'ApiController@user_one_by');
Route::get('/users-by/{token}/{reference}/{value}', 'ApiController@users_by');
