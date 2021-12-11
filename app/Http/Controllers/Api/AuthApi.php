<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('users')
            ->where("email", '=', $request->email)
            ->first();

        if ($user) {
            if ($user->level == 'teknisi')
            {
                $data = DB::table('users')
                    ->join('teknisi', 'teknisi.email', '=', 'users.email')
                    ->select('users.*', 'teknisi.teknisi_id', 'teknisi.teknisi_hp as hp', 'teknisi.teknisi_alamat as alamat', 'teknisi.teknisi_foto as foto', 'teknisi.teknisi_sertifikat', 'teknisi.teknisi_nama_toko as nama_toko', 'teknisi.teknisi_lat as lat', 'teknisi.teknisi_lng as lng', 'teknisi.teknisi_deskripsi as deskripsi')
                    ->where('users.email', $request->email)
                    ->first();
            }
            else if ($user->level == "pelanggan")
            {

                $data = DB::table('users')
                    ->join('pelanggan', 'pelanggan.email', '=', 'users.email')
                    ->select('users.*', 'pelanggan.pelanggan_id', 'pelanggan.pelanggan_hp as hp', 'pelanggan.pelanggan_alamat as alamat', 'pelanggan.pelanggan_foto as foto', 'pelanggan.pelanggan_lat as lat', 'pelanggan.pelanggan_lng as lng')
                    ->where('users.email', $request->email)
                    ->first();
            }
            else
            {
                $data = DB::table('users')
                    ->where('email', $request->email)
                    ->first();
            }

            $pw = Hash::check($request->password, $user->password);
            if ($pw)
            {
                return response()->json([
                    'code' => 200,
                    'result' => $data,
                    'message' => "SUCCESS"
                ], 200);
            }
            else
            {
                return response()->json([
                    'code' => 422,
                    'result' => "",
                    'message' => "Password salah"
                ], 422);
            }
        } else {
            return response()->json([
                'code' => 404,
                'result' => "",
                'message' => "Data tidak ditemukan"
            ], 404);
        }
    }
}
