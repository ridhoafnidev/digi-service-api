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
            'by_kurir' => $request->by_kurir,
            'status_service' => 'proses'
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

    public function update_service_handphone(Request $request)
    {
        $update_service_handphone = DB::table("service_handphone")
            ->where('service_handphone_id', '=', $request->service_handphone_id)
            ->update([
                'status_service' => $request->status_service
            ]);

        if ($update_service_handphone) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Update Berhasil Disimpan!',
                'result' => "",
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'status' => "FAILED",
                'message' => 'Update Gagal Disimpan!',
                'result' => "",
            ], 400);
        }
    }

    public function service_handphone_by_teknisi(Request $request)
    {
        $service_handphone = DB::table("service_handphone")
            ->where('teknisi_id', '=', $request->teknisi_id)
            ->where('status_service', '=', 'proses')
            ->join('pelanggan', 'service_handphone.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->get();
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

    public function service_handphone_history_by_teknisi(Request $request)
    {
        $service_handphone = DB::table("service_handphone")
            ->where('teknisi_id', '=', $request->teknisi_id)
            ->join('pelanggan', 'service_handphone.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->get();
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

    public function service_handphone_history_by_pelanggan(Request $request)
    {
        $service_handphone = DB::table("service_handphone")
            ->where('pelanggan_id', '=', $request->pelanggan_id)
            ->join('teknisi', 'service_handphone.teknisi_id', '=', 'teknisi.teknisi_id')
            ->get();
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

    public function service_handphone_by_id(Request $request)
    {
        $service_handphone = DB::table("service_handphone")
            ->where('service_handphone_id', '=', $request->service_handphone_id)
            ->join('pelanggan', 'service_handphone.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->first();
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
