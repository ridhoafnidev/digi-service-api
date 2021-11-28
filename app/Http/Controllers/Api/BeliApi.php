<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Beli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeliApi extends Controller
{
    public function history_beli_produk_by_user_id(Request $request) {
        $user = User::where("id", $request->beli_pembeli)->first();
        $level = $user->level;
        $history_beli_produk ="";
        if($level == "teknisi"){
            $history_beli_produk = DB::table('beli')
                ->select("beli.*")
                ->join('teknisi', 'teknisi.teknisi_id', '=', 'beli.beli_pembeli')
                ->join('jual', 'beli.beli_jual_id', '=', 'jual.jual_id')
                ->get();

        }
        else{
            $history_beli_produk = DB::table('beli')
                ->select("beli.*", 'pelanggan.nama')
                ->join('users', 'users.id', '=', 'beli.beli_pembeli')
                ->join('pelanggan', 'pelanggan.email', '=', 'users.email')
                ->join('jual', 'beli.beli_jual_id', '=', 'jual.jual_id')
                ->get();

            return response()->json([
                'code' => 200,
                'result' => $history_beli_produk,
                'message' => "SUCCESS"
            ], 200);
        }
    }

    public function buy_product(Request $request){
        $buy = new Beli();
        $buy->beli_jual_id = $request->beli_jual_id;
        $buy->beli_jasa_kurir = $request->beli_jasa_kurir;
        $buy->beli_pembeli = $request->beli_pembeli;
        if ($buy->save()){
            return response()->json([
                'code' => 200,
                'status' => "Success",
                'message' => 'Berhasil membeli!',
                'result' => "",
            ], 200);
        }
        else{
            return response()->json([
                'code' => 422,
                'status' => "Success",
                'message' => 'Berhasil membeli!',
                'result' => "",
            ], 422);
        }

    }
}
