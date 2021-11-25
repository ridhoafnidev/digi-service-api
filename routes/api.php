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
Route::post('/teknisi-search-by', 'Api\TeknisiApi@search_by');
Route::get('/teknisi-find-nearby/{latitide}/{longitude}', 'Api\TeknisiApi@find_teknisi_nearby_location');
Route::post('/teknisi-insert', 'Api\TeknisiApi@insert_teknisi');
Route::post('/teknisi-update/{id}', 'Api\TeknisiApi@update_teknisi');
Route::delete('/teknisi-delete/{id}', 'Api\TeknisiApi@delete_teknisi');
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

// Jenis Kerusakan
Route::get('/jenis-kerusakan-all', 'Api\JenisKerusakanApi@jenis_kerusakan_all');
Route::get('/jenis-kerusakan-by/{referance}/{value}', 'Api\JenisKerusakanApi@jenis_kerusakan_by');
Route::get('/jenis-kerusakan-one/{id}', 'Api\JenisKerusakanApi@jenis_kerusakan_one_by');
Route::post('/jenis-kerusakan-insert', 'Api\JenisKerusakanApi@insert_jenis_kerusakan');
Route::put('/jenis-kerusakan-update/{id}', 'Api\JenisKerusakanApi@update_jenis_kerusakan');


Route::post('/insert-teknisi-jenis-hp-keahlian', 'Api\TeknisiApi@insert_teknisi_jenis_hp_keahlian');
Route::get('/keahlian-teknisi-by/{teknisi_id}', 'Api\TeknisiApi@get_keahlian_teknisi_by');
Route::get('/jenis-hp-by/{teknisi_id}', 'Api\TeknisiApi@get_jenis_hp_by');

// Produk
Route::get('/produk-all', 'Api\ProdukApi@produk_all');
Route::get('/produk-detail/{id}', 'Api\ProdukApi@produk_detail');

// Service Handphone
Route::get('/service-handphone-by-teknisi/{teknisi_id}', 'Api\ServiceHandphoneApi@service_handphone_by_teknisi');
Route::get('/service-handphone-by-id/{service_handphone_id}', 'Api\ServiceHandphoneApi@service_handphone_by_id');
Route::post('/service-handphone-insert', 'Api\ServiceHandphoneApi@insert_service_handphone');
Route::put('/service-handphone-update/{service_handphone_id}', 'Api\ServiceHandphoneApi@update_service_handphone');

//Login
Route::post('/login', 'Api\AuthApi@login');

// Register
//Route::post('/register-service', 'Api\AuthApi@register_servicer');
//Route::post('/register-buyer', 'Api\AuthApi@register_buyer');


Route::get('/user-all/{token}', 'ApiController@user_all');
Route::get('/user-one/{token}/{reference}/{value}', 'ApiController@user_one_by');
Route::get('/users-by/{token}/{reference}/{value}', 'ApiController@users_by');
