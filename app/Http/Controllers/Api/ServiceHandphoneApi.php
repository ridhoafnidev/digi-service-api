<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceHandphoneApi extends Controller
{
    public function insert_service_handphone(Request $request)
    {
        $insert_service_handphone = DB::table("service_handphone")->insert([
            'pelanggan_id' => $request->pelanggan_id,
            'teknisi_id' => $request->teknisi_id,
            'jenis_hp' => $request->jenis_hp,
            'jenis_kerusakan' => $request->jenis_kerusakan,
            'by_kurir' => $request->by_kurir
        ]);

        if ($insert_service_handphone) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Post Berhasil Disimpan!',
                'result' => "",
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'status' => "FAILED",
                'message' => 'Post Gagal Disimpan!',
                'result' => "",
            ], 400);
        }
    }

    public function service_handphone_all()
    {
        $service_handphone = DB::table("service_handphone")->get();
        if ($service_handphone) {
            return response()->json([
                'code' => 200,
                'result' => $service_handphone,
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
}
