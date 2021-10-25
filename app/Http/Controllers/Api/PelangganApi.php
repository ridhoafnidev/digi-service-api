<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $pelanggan = new Pelanggan();
        $users = new User();

        $pelanggan_foto = $request->file('pelanggan_foto');

        if($this->email_check($request->email, "pelanggan") == 1)
        {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, Email sudah terdaftar',
            ], 500);
        }
        else
        {
            if ($pelanggan_foto != null )
            {

                $users->email = $request->email;
                $users->name = $request->pelanggan_nama;
                $users->level = "pelanggan";
                $users->password = Hash::make($request->password);
                $users->save();

                if ($users)
                {
                    $pelanggan->email = $request->email;
                    $pelanggan->pelanggan_nama = $request->pelanggan_nama;
                    $pelanggan->pelanggan_alamat = $request->pelanggan_alamat;
                    $pelanggan->pelanggan_lat = $request->pelanggan_lat;
                    $pelanggan->pelanggan_lng = $request->pelanggan_lng;
                    $pelanggan->pelanggan_hp = $request->pelanggan_hp;
                    $pelanggan->pelanggan_foto = $request->pelanggan_nama.'_'.$pelanggan_foto->getClientOriginalName();
                    $pelanggan->save();
                    $pelanggan_foto->move(public_path('foto-pelanggan'), $request->pelanggan_nama.'_'.$pelanggan_foto->getClientOriginalName());
                }
                if ($users && $pelanggan)
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
                $users->name = $request->pelanggan_nama;
                $users->level = "pelanggan";
                $users->password = Hash::make($request->password);
                $users->save();
                if ($users)
                {
                    $pelanggan->email = $request->email;
                    $pelanggan->pelanggan_nama = $request->pelanggan_nama;
                    $pelanggan->pelanggan_alamat = $request->pelanggan_alamat;
                    $pelanggan->pelanggan_lat = $request->pelanggan_lat;
                    $pelanggan->pelanggan_lng = $request->pelanggan_lng;
                    $pelanggan->pelanggan_hp = $request->pelanggan_hp;
                    $pelanggan->save();
                }

                if ($users && $pelanggan)
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

    public function update_pelanggan($id,Request $request){
        $pelanggan = Pelanggan::find($id);
        $pelanggan->email = $request->email;
        $pelanggan->pelanggan_nama = $request->pelanggan_nama;
        $pelanggan->pelanggan_alamat = $request->pelanggan_alamat;
        $pelanggan->pelanggan_lat = $request->pelanggan_lat;
        $pelanggan->pelanggan_lng = $request->pelanggan_lng;
        $pelanggan->pelanggan_hp = $request->pelanggan_hp;
        $pelanggan->save();
        if($pelanggan){
            echo json_encode(array('kode' => 200, 'status' => "Berhasil"));
        }else{
            echo json_encode(array('kode' => 404, 'status' => "Gagal"));
        }
    }

    public function delete_pelanggan($id){
        $pelanggan = DB::table('pelanggan')->where('pelanggan_id', $id)->delete();
        if($pelanggan){
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
