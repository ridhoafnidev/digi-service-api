<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Teknisi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $users = new User();

        $teknisi_foto = $request->file('teknisi_foto');
        $teknisi_sertifikat = $request->file('teknisi_sertifikat');

        if($this->email_check($request->email, "teknisi") == 1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, Email sudah terdaftar',
            ], 500);
        }
        else
        {
            if ($teknisi_foto != null )
            {
                if ($teknisi_sertifikat != null)
                {

                    $users->email = $request->email;
                    $users->name = $request->teknisi_nama;
                    $users->level = "teknisi";
                    $users->password = Hash::make($request->password);
                    $users->save();
                    if ($users){
                        $teknisi->email = $request->email;
                        $teknisi->teknisi_nama = $request->teknisi_nama;
                        $teknisi->teknisi_nama_toko = $request->teknisi_nama_toko;
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
                    }
                    if ($users && $teknisi)
                    {
                        return response()->json([
                            'success' => true,
                            'message' => 'Post Berhasil Disimpan!',
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'success' => false,
                            'message' => 'Gagal Disimpan!',
                        ], 404);
                    }
                }
                else
                {
                    $users->email = $request->email;
                    $users->name = $request->teknisi_nama;
                    $users->level = "teknisi";
                    $users->password = Hash::make($request->password);
                    $users->save();

                    if ($users)
                    {
                        $teknisi->email = $request->email;
                        $teknisi->teknisi_nama = $request->teknisi_nama;
                        $teknisi->teknisi_nama_toko = $request->teknisi_nama_toko;
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
                    }

                    if ($users && $teknisi)
                    {
                        return response()->json([
                            'success' => true,
                            'message' => 'Post Berhasil Disimpan!',
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'success' => false,
                            'message' => 'Gagal Disimpan!',
                        ], 404);
                    }

                }
            }
            else
            {

                $users->email = $request->email;
                $users->name = $request->teknisi_nama;
                $users->level = "teknisi";
                $users->password = Hash::make($request->password);
                $users->save();

                if ($users)
                {
                    $teknisi->email = $request->email;
                    $teknisi->teknisi_nama = $request->teknisi_nama;
                    $teknisi->teknisi_nama_toko = $request->teknisi_nama_toko;
                    $teknisi->teknisi_alamat = $request->teknisi_alamat;
                    $teknisi->teknisi_lat = $request->teknisi_lat;
                    $teknisi->teknisi_lng = $request->teknisi_lng;
                    $teknisi->teknisi_hp = $request->teknisi_hp;
                    $teknisi->teknisi_total_score = $request->teknisi_total_score;
                    $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
                    $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
                    $teknisi->save();
                }

                if ($users && $teknisi)
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'Post Berhasil Disimpan!',
                    ], 200);
                }
                else
                {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal Disimpan!',
                    ], 404);
                }
            }
        }
    }

    public function update_teknisi($id,Request $request){
        $teknisi = Teknisi::find($id);
        $teknisi->email = $request->email;
        $teknisi->teknisi_nama = $request->teknisi_nama;
        $teknisi->teknisi_nama_toko = $request->teknisi_nama_toko;
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

    public  function email_check($email, $level)
    {
        $checkEmail = DB::table('users')
            ->where('email', '=', $email)
            ->where('level', '=', $level)
            ->count();
        if ($checkEmail > 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }

}
