<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Produk;
use App\Teknisi;
use App\TeknisiKerusakanJenisHp;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdukApi extends Controller
{

    public function produk_all()
    {
        $data = DB::table('jual')
            ->select('jual.*')
            ->orderBy('jual_id', 'desc')
            ->get();

        if ($data) {
             return response()->json([
                            'code' => 200,
                            'result' => $data,
                            'message' => "SUCCESS"
                        ], 200);
        }else{
            return response()->json([
                            'code' => 404,
                            'result' => "",
                            'message' => "FAILED"
                        ], 404);
        }
    }

    public function produk_by_user_id(Request $request)
    {
        $data = DB::table('jual')
            ->select('jual.*')
            ->where('jual_user_id', '=', $request->user_id)
            ->orderBy('jual_id', 'desc')
            ->get();

        if ($data) {
            return response()->json([
                'code' => 200,
                'result' => $data,
                'message' => "SUCCESS"
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'result' => "",
                'message' => "FAILED"
            ], 404);
        }
    }


    public function produk_detail($id)
    {
        $data = DB::table('jual')
            ->select('jual.*')
            ->where('jual_id', '=', $id)
            ->orderBy('jual_id', 'desc')
            ->first();

        if ($data) {
            return response()->json([
                'code' => 200,
                'result' => $data,
                'message' => "SUCCESS"
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'result' => "",
                'message' => "FAILED"
            ], 404);
        }
    }

    public function produk_insert(Request $request) {
        $jual = new Produk();

        $foto_produk = $request->file("foto");

        $jual->jual_harga = $request->jual_harga;
        $jual->jual_deskripsi = $request->jual_deskripsi;
        $jual->jual_user_id = $request->jual_user_id;
        $jual->jual_judul = $request->jual_judul;
        $jual->jual_jenis_hp = $request->jual_jenis_hp;
        $jual->foto_produk = $request->foto->getClientOriginalName();
        $jual->save();
        $foto_produk->move(public_path('foto-produk'), $request->foto->getClientOriginalName());
        if ($jual) {
            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'Berhasil menyimpan!',
                'result' => "",
            ], 200);
        }
        else{
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => 'Gagal menyimpan!',
                'result' => "",
            ], 400);
        }
    }
}
