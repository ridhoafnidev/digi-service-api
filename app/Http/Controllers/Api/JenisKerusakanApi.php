<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JenisKerusakan;
use Illuminate\Http\Request;

class JenisKerusakanApi extends Controller
{
    private $JenisKerusakan;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->JenisKerusakan = new JenisKerusakan();

    }

    public function jenis_kerusakan_all()
    {
        $data = $this->JenisKerusakan->getJenisKerusakan();
        if ($data) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => "Data ditemukan",
                'result' => $data,
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'status' => "FAILED",
                'message' => "Data ditemukan",
                'result' => "",
            ], 404);
        }
    }
    public function jenis_kerusakan_by($reference,$value)
    {
        $data = $this->JenisKerusakan->getJenisKerusakanBy($reference,$value);
        if ($data) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => "Data ditemukan",
                'result' => $data,
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'status' => "FAILED",
                'message' => "Data tidak ditemukan",
                'result' => "",
            ], 404);
        }
    }
    public function jenis_kerusakan_one_by($reference,$value)
    {
        $data = $this->JenisKerusakan->getJenisKerusakanOneBy($reference,$value);
        if ($data) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => "Data ditemukan",
                'result' => $data,
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'status' => "FAILED",
                'message' => "Data tidak ditemukan",
                'result' => "",
            ], 404);
        }
    }
    public function insert_jenis_kerusakan(Request $request){
        $jenisKerusakan = new JenisKerusakan();

        $jenisKerusakan->nama_kerusakan = $request->nama_kerusakan;
        $jenisKerusakan->deskripsi_kerusakan = $request->deskripsi_kerusakan;
        $jenisKerusakan->save();
        return response()->json([
            'code' => true,
            'status' => "SUCCESS",
            'message' => 'Post Berhasil Disimpan!',
            'result' => "",
        ], 200);

    }

    public function update_jenis_hp($id,Request $request){
        $jenisKerusakan = JenisKerusakan::find($id); 
        
        $jenisKerusakan->nama_kerusakan = $request->nama_kerusakan;
        $jenisKerusakan->deskripsi_kerusakan = $request->deskripsi_kerusakan;
        $jenisKerusakan->save();
        if($jenisKerusakan){
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Berhasil diupdate',
                'result' => "",
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'status' => "FAILED",
                'message' => 'Gagal diupdate!',
                'result' => "",
            ], 404);
        }
    }

}
