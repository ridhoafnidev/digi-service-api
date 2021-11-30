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
use mysql_xdevapi\Exception;

class ProdukApi extends Controller
{

    public function produk_all()
    {
        $data = DB::table('jual')
            ->select('jual.*', 'jenis_hp.jenis_nama', 'jenis_hp.jenis_thumbnail')
            ->join('jenis_hp', 'jenis_hp.jenis_id', '=', 'jual.jual_jenis_hp')
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
            ->select('jual.*', 'jenis_hp.jenis_nama', 'jenis_hp.jenis_thumbnail')
            ->join('jenis_hp', 'jenis_hp.jenis_id', '=', 'jual.jual_jenis_hp')
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
            ->join('users', 'jual.jual_user_id', '=', 'users.id')
            ->join('jenis_hp', 'jual.jual_jenis_hp', '=', 'jenis_hp.jenis_id')
            ->select('jual.*', 'users.name','jenis_hp.jenis_nama', 'jenis_hp.jenis_thumbnail')
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

    public function produk_update(Request $request) {

        $id = $request->id;

        $jual = Produk::find($id);

        $foto_produk = $request->file("foto");
        if ($foto_produk != null){
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
        else{
            $jual->jual_harga = $request->jual_harga;
            $jual->jual_deskripsi = $request->jual_deskripsi;
            $jual->jual_user_id = $request->jual_user_id;
            $jual->jual_judul = $request->jual_judul;
            $jual->jual_jenis_hp = $request->jual_jenis_hp;
            $jual->save();
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

    public function produk_delete($id){
        try {
            $product = Produk::where('jual_id',$id)->delete();
            if ($product){
                return response()->json([
                    'code' => 200,
                    'status' => "Success",
                    'message' => 'Berhasil dihapus!',
                    'result' => "",
                ], 200);
            }
        }
        catch (Exception $exception){
            return response()->json([
                'code' => 400,
                'status' => "Failed",
                'message' => $exception->getMessage(),
                'result' => "",
            ], 400);
        }
    }
}
