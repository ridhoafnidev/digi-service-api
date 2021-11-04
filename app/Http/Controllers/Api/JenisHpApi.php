<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\JenisHp;
use Illuminate\Http\Request;

class JenisHpApi extends Controller
{
    private $JenisHp;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->JenisHp = new JenisHp();

    }

    public function jenis_hp_all()
    {
        $data = $this->JenisHp->getJenisHp();
        if ($data) {
            return response()->json([
                'code' => 200,
                'result' => $data,
                'message' => "SUCCESS",
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'result' => "",
                'message' => "FAILED",
            ], 404);
        }
    }
    public function jenis_hp_by($reference,$value)
    {
        $data = $this->JenisHp->getJenisHpBy($reference,$value);
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => "SUCCESS",
                'result' => $data,
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'message' => "FAILED",
                'result' => "",
            ], 404);
        }
    }
    public function jenis_hp_one_by($reference,$value)
    {
        $data = $this->JenisHp->getJenisHpOneBy($reference,$value);
        if ($data) {
            return response()->json([
                'code' => 200,
                'message' => "SUCCESS",
                'result' => $data,
            ], 200);
        }else{
            return response()->json([
                'code' => 404,
                'message' => "FAILED",
                'result' => "",
            ], 404);
        }
    }
    public function insert_jenis_hp(Request $request){
        $jenisHp = new JenisHp();

        $jenis_thumbnail = $request->file('jenis_thumbnail');

        if ($jenis_thumbnail != null ){
            $jenisHp->jenis_nama = $request->jenis_nama;
            $jenisHp->jenis_thumbnail = $request->jenis_nama.'_'.$jenis_thumbnail->getClientOriginalName();
            $jenisHp->save();
            $jenis_thumbnail->move(public_path('foto-jenis-hp'), $request->jenis_nama.'_'.$jenis_thumbnail->getClientOriginalName());
            return response()->json([
                'code' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);

        }else{
            $jenisHp->jenis_nama = $request->jenis_nama;
            $jenisHp->save();
            return response()->json([
                'code' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        }
    }

    public function update_jenis_hp($id,Request $request){
        $jenisHp = JenisHp::find($id);
        $jenisHp->jenis_nama = $request->jenis_nama;
        $jenisHp->save();
        if($jenisHp){
            echo json_encode(array('code' => 200, 'message' => "Berhasil"));
        }else{
            echo json_encode(array('code' => 404, 'message' => "Gagal"));
        }
    }
    public function delete_jenis_hp($id){
        $jenisHp = DB::table('JenisHp')->where('jenis_id', $id)->delete();
        if($jenisHp){
            echo json_encode(array('code' => 200, 'message' => "Berhasil"));
        }else{
            echo json_encode(array('code' => 404, 'message' => "Gagal"));
        }
    }

}
