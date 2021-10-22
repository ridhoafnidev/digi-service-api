<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pelanggan;

class PelangganApi extends Controller
{
    private $pelanggan;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->Pelanggan = new Pelanggan();

    } 

    public function pelanggan_all()
    {
        $data = $this->Pelanggan->getPelanggan();
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function pelanggan_by($reference,$value)
    {
        $data = $this->Pelanggan->getPelangganBy($reference,$value);
        if ($data) {
            echo json_encode(array('kode'=> 1,'result' => $data));
        }else{
            echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
        }
    }
    public function insert_pelanggan(Request $request){
        $pelanggan = new Teknisi();

        $pelanggan_foto = $request->file('teknisi_foto');
        $pelanggan_sertifikat = $request->file('teknisi_sertifikat');

        if ($pelanggan_foto != null ){
            if ($pelanggan_sertifikat != null){
                $pelanggan->teknisi_nama = $request->teknisi_nama;
                $pelanggan->teknisi_alamat = $request->teknisi_alamat;
                $pelanggan->teknisi_lat = $request->teknisi_lat;
                $pelanggan->teknisi_lng = $request->teknisi_lng;
                $pelanggan->teknisi_hp = $request->teknisi_hp;
                $pelanggan->teknisi_total_score = $request->teknisi_total_score;
                $pelanggan->teknisi_total_responden = $request->teknisi_total_responden;
                $pelanggan->teknisi_deskripsi = $request->teknisi_deskripsi;
                $pelanggan->teknisi_foto = $request->teknisi_nama.'_'.$pelanggan_foto->getClientOriginalName();
                $pelanggan->teknisi_sertifikat = $request->teknisi_nama.'_'.$pelanggan_sertifikat->getClientOriginalName();
                $pelanggan->save();
                $pelanggan_foto->move(public_path('foto-teknisi'), $request->teknisi_nama.'_'.$pelanggan_foto->getClientOriginalName());
                $pelanggan_sertifikat->move(public_path('foto-sertifikat'), $request->teknisi_nama.'_'.$pelanggan_sertifikat->getClientOriginalName());
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            }else{
                $pelanggan->teknisi_nama = $request->teknisi_nama;
                $pelanggan->teknisi_alamat = $request->teknisi_alamat;
                $pelanggan->teknisi_lat = $request->teknisi_lat;
                $pelanggan->teknisi_lng = $request->teknisi_lng;
                $pelanggan->teknisi_hp = $request->teknisi_hp;
                $pelanggan->teknisi_total_score = $request->teknisi_total_score;
                $pelanggan->teknisi_total_responden = $request->teknisi_total_responden;
                $pelanggan->teknisi_deskripsi = $request->teknisi_deskripsi;
                $pelanggan->teknisi_foto = $request->teknisi_nama.'_'.$pelanggan_foto->getClientOriginalName();
                $pelanggan->save();
                $pelanggan_foto->move(public_path('foto-teknisi'), $request->teknisi_nama.'_'.$pelanggan_foto->getClientOriginalName());
                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Disimpan!',
                ], 200);
            }
        }else{
            $pelanggan->teknisi_nama = $request->teknisi_nama;
            $pelanggan->teknisi_alamat = $request->teknisi_alamat;
            $pelanggan->teknisi_lat = $request->teknisi_lat;
            $pelanggan->teknisi_lng = $request->teknisi_lng;
            $pelanggan->teknisi_hp = $request->teknisi_hp;
            $pelanggan->teknisi_total_score = $request->teknisi_total_score;
            $pelanggan->teknisi_total_responden = $request->teknisi_total_responden;
            $pelanggan->teknisi_deskripsi = $request->teknisi_deskripsi;
            $pelanggan->save();
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
            ], 200);
        }
    }

    public function update_pelanggan($id,Request $request){
        $pelanggan = Pelanggan::find($id);
        $pelanggan->teknisi_nama = $request->teknisi_nama;
        $pelanggan->teknisi_alamat = $request->teknisi_alamat;
        $pelanggan->teknisi_lat = $request->teknisi_lat;
        $pelanggan->teknisi_lng = $request->teknisi_lng;
        $pelanggan->teknisi_hp = $request->teknisi_hp;
        $pelanggan->teknisi_total_score = $request->teknisi_total_score;
        $pelanggan->teknisi_total_responden = $request->teknisi_total_responden;
        $pelanggan->teknisi_deskripsi = $request->teknisi_deskripsi;
        $pelanggan->save();
        if($pelanggan){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }
    public function delete_pelanggan($id){
        $pelanggan = DB::table('teknisi')->where('teknisi_id', $id)->delete();
        if($pelanggan){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }
}
