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
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function jenis_hp_by($reference,$value)
    {
        $data = $this->JenisHp->getJenisHpBy($reference,$value);
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function jenis_hp_one_by($reference,$value)
    {
        $data = $this->JenisHp->getJenisHpOneBy($reference,$value);
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
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
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);

        }else{
            $jenisHp->jenis_nama = $request->jenis_nama;
            $jenisHp->save();
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        }
    }

    public function update_jenis_hp($id,Request $request){
        $jenisHp = JenisHp::find($id);
        $jenisHp->jenis_nama = $request->jenis_nama;
        $jenisHp->save();
        if($jenisHp){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }
    public function delete_jenis_hp($id){
        $jenisHp = DB::table('JenisHp')->where('jenis_id', $id)->delete();
        if($jenisHp){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }

}
