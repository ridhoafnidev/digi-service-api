<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pelanggan;
use App\Produk;
use App\Review;
use App\Teknisi;
use App\User;
use App\Beli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeliApi extends Controller
{
    public function history_beli_produk_by_user_id($id) {
        $user = User::where("id", $id)->first();
        $level = $user->level;

        $history_beli_produk ="";

        if($level == "teknisi"){
            $history_beli_produk = DB::table('beli')
                ->join('users', 'users.id', '=', 'beli.beli_pembeli')
                ->join('teknisi', 'teknisi.email', '=', 'users.email')
                ->join('jual', 'beli.beli_jual_id', '=',     'jual.jual_id')
                ->where('beli.beli_pembeli', $id)
                ->get();

        } else {
            $history_beli_produk = DB::table('beli')
                ->join('users', 'users.id', '=', 'beli.beli_pembeli')
                ->join('pelanggan', 'pelanggan.email', '=', 'users.email')
                ->join('jual', 'beli.beli_jual_id', '=', 'jual.jual_id')
                ->where('beli.beli_pembeli', $id)
                ->get();
        }

        if ($history_beli_produk) {
            return response()->json([
                'code' => 200,
                'result' => $history_beli_produk,
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

    public function review(Request $request){

        $beli = Beli::where('beli_id', $request->beli_id)->first();

        if ($beli->is_reviewed == 0){

            $beli->rating = $request->nilai;
            $beli->isi_review = $request->isi;
            $beli->is_reviewed = 1;

            if ($beli->save()){
                $jual = Produk::where('jual_id', $beli->beli_jual_id)->first();
                $user = User::where('id', $jual->jual_user_id)->first();
                if ($user->level == "pelanggan"){
                    $pelanggan = Pelanggan::where('email', $user->email)->first();
                    $pelanggan->pelanggan_total_score += $request->nilai;
                    $pelanggan->pelanggan_total_responden += 1;
                    $pelanggan->save();
                }
                else if ($user->level == "teknisi") {
                    $pelanggan = Teknisi::where('email', $user->email)->first();
                    $pelanggan->teknisi_total_score += $request->nilai;
                    $pelanggan->teknisi_total_responden += 1;
                    $pelanggan->save();
                }
            }

            if ($pelanggan){
                return response()->json([
                    'code' => 200,
                    'status' => "Success",
                    'message' => "Berhasil mereview",
                    'result' => "",
                ], 200);
            }
            else{
                return response()->json([
                    'code' => 500,
                    'status' => "Failed",
                    'message' => "Gagal mereview",
                    'result' => ""
                ], 500);
            }
        }
        else{
            return response()->json([
                'code' => 404,
                'status' => "Failed",
                'message' => "Gagal produk sudah di review",
                'result' => ""
            ], 404);
        }
    }
}
