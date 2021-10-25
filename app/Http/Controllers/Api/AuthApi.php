<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $user = DB::table('users')
            ->where("email", $request->email)
            ->first();

        if ($user->level == "teknisi")
        {
            $data = DB::table('users')
                ->join('teknisi', 'teknisi.email', '=', 'users.email')
                ->select('users.*', 'teknisi.teknisi_id')
                ->where('users.email', $request->email)
                ->first();
        }
        else if ($user->level == "pelanggan")
        {
            $data = DB::table('users')
                ->join('pelanggan', 'pelanggan.email', '=', 'users.email')
                ->select('users.*', 'pelanggan.pelanggan_id')
                ->where('users.email', $request->email)
                ->first();
        }
        else
        {
            $data = DB::table('users')
                ->where('email', $request->email)
                ->first();
        }
        if ($user){
            $pw = Hash::check($request->password, $user->password);
            if ($pw)
            {
                echo json_encode(array('kode' => 200, 'result' => $data));
            }
            else
            {
                echo json_encode(array('kode' => 403, 'pesan' => "Password salah"));
            }
        }
        else
        {
            echo json_encode(array('kode' => 404, 'pesan' => "Data tidak ditemukan"));
        }
    }
}
