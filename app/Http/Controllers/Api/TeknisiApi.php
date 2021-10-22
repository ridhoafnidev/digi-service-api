<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Teknisi;
use Illuminate\Http\Request;

class TeknisiApi extends Controller
{ 
    private $Teknisi;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->Teknisi = new Teknisi();

    }

    public function teknisi_all()
    {
        $data = $this->Teknisi->getTeknisi();
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function teknisi_by($reference,$value)
    {
        $data = $this->Teknisi->getTeknisiBy($reference,$value);
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function teknisi_one_by($reference,$value)
    {
        $data = $this->Teknisi->getTeknisiOneBy($reference,$value);
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function insert_teknisi(Request $request){
        $teknisi = new Teknisi();

        $teknisi_foto = $request->file('teknisi_foto');
        $teknisi_sertifikat = $request->file('teknisi_sertifikat');

        if ($teknisi_foto != null ){
            if ($teknisi_sertifikat != null){
                $teknisi->teknisi_nama = $request->teknisi_nama;
                $teknisi->teknisi_alamat = $request->teknisi_alamat;
                $teknisi->teknisi_lat = $request->teknisi_lat;
                $teknisi->teknisi_lng = $request->teknisi_lng;
                $teknisi->teknisi_hp = $request->teknisi_hp;
                $teknisi->teknisi_total_score = $request->teknisi_total_score;
                $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
                $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
                $teknisi->teknisi_foto = $request->teknisi_nama.'_'.$teknisi_foto->getClientOriginalName();
                $teknisi->teknisi_sertifikat = $request->teknisi_nama.'_'.$teknisi_sertifikat->getClientOriginalName();
                $teknisi->save();
                $teknisi_foto->move(public_path('foto-teknisi'), $request->teknisi_nama.'_'.$teknisi_foto->getClientOriginalName());
                $teknisi_sertifikat->move(public_path('foto-sertifikat'), $request->teknisi_nama.'_'.$teknisi_sertifikat->getClientOriginalName());
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            }else{
                $teknisi->teknisi_nama = $request->teknisi_nama;
                $teknisi->teknisi_alamat = $request->teknisi_alamat;
                $teknisi->teknisi_lat = $request->teknisi_lat;
                $teknisi->teknisi_lng = $request->teknisi_lng;
                $teknisi->teknisi_hp = $request->teknisi_hp;
                $teknisi->teknisi_total_score = $request->teknisi_total_score;
                $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
                $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
                $teknisi->teknisi_foto = $request->teknisi_nama.'_'.$teknisi_foto->getClientOriginalName();
                $teknisi->save();
                $teknisi_foto->move(public_path('foto-teknisi'), $request->teknisi_nama.'_'.$teknisi_foto->getClientOriginalName());
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            }
        }else{
            $teknisi->teknisi_nama = $request->teknisi_nama;
            $teknisi->teknisi_alamat = $request->teknisi_alamat;
            $teknisi->teknisi_lat = $request->teknisi_lat;
            $teknisi->teknisi_lng = $request->teknisi_lng;
            $teknisi->teknisi_hp = $request->teknisi_hp;
            $teknisi->teknisi_total_score = $request->teknisi_total_score;
            $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
            $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
            $teknisi->save();
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        }
    }

    public function update_teknisi($id,Request $request){
        $teknisi = Teknisi::find($id);
        $teknisi->teknisi_nama = $request->teknisi_nama;
        $teknisi->teknisi_alamat = $request->teknisi_alamat;
        $teknisi->teknisi_lat = $request->teknisi_lat;
        $teknisi->teknisi_lng = $request->teknisi_lng;
        $teknisi->teknisi_hp = $request->teknisi_hp;
        $teknisi->teknisi_total_score = $request->teknisi_total_score;
        $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
        $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
        $teknisi->save();
        if($teknisi){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }
    public function delete_teknisi($id){
        $teknisi = DB::table('teknisi')->where('teknisi_id', $id)->delete();
        if($teknisi){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }

}
