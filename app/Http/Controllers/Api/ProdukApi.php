<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function insert_produk(Request $request) {

    }
}
