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
                 return response()->json([
                            'code' => 200,
                            'result' => $data
                        ], 200);
            }
            else
            {
                  return response()->json([
                            'code' => 422,
                            'message' => "Password salah"
                        ], 422);
                }
        }
        else
        {
        
            return response()->json([
                            'code' => 404,
                            'message' => "Data tidak ditemukan"
                        ], 404);
        }
    }
}