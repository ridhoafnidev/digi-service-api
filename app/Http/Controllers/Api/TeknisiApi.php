<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Teknisi;
use App\TeknisiJenisHp;
use App\TeknisiKerusakanJenisHp;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeknisiApi extends Controller
{
    private $Teknisi;

    public function __construct()
    {
        $this->Teknisi = new Teknisi();
    }

    public function teknisi_all()
    {
        $data = $this->Teknisi->getTeknisi();
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

    public function find_teknisi_nearby_location($latitude, $longitude)
    {
        $location = DB::table('teknisi')
            ->select(
                'teknisi.*',
                DB::raw(sprintf(
                    '(6371 * acos(cos(radians(%1$.7f)) * cos(radians(teknisi.teknisi_lat)) * cos(radians(teknisi.teknisi_lng) - radians(%2$.7f)) + sin(radians(%1$.7f)) * sin(radians(teknisi.teknisi_lat)))) AS distance',
                    $latitude,
                    $longitude
                ))
            )
            ->orderBy('distance', 'asc')
            ->get();

        if ($location != null || $location != '') {
           return response()->json([
                            'code' => 200,
                            'result' => $location,
                            'message' => "SUCCESS"
                        ], 200);
        } else {
             return response()->json([
                            'code' => 404,
                            'result' => "",
                            'message' => "FAILED"
                        ], 404);
        }
    }

    public function search_by() {

        $rawData = json_decode(file_get_contents("php://input"), true);

        $jenisHpRaw = $rawData['jenis_hp'];
        $jenisKerusakanRaw = $rawData['jenis_kerusakan'];

        try {
            $teknisiSearch = DB::table('teknisi')
                ->select('teknisi.*')
                ->join('teknisi_kerusakan_jenis_hp', 'teknisi_kerusakan_jenis_hp.teknisi_id', '=', 'teknisi.teknisi_id')
                ->join('detail_teknisi_jenis_kerusakan_hp', 'detail_teknisi_jenis_kerusakan_hp.teknisi_kerusakan_jenis_hp_id', '=', 'teknisi_kerusakan_jenis_hp.id')
                ->join('jenis_kerusakan_hp', 'detail_teknisi_jenis_kerusakan_hp.jenis_kerusakan_hp_id', '=', 'jenis_kerusakan_hp.id_jenis_kerusakan')
                ->join('teknisi_jenis_hp', 'teknisi_jenis_hp.teknisi_id', '=', 'teknisi.teknisi_id')
                ->join('detail_teknisi_jenis_hp', 'detail_teknisi_jenis_hp.teknisi_jenis_hp_id', '=', 'teknisi_jenis_hp.id')
                ->join('jenis_hp', 'detail_teknisi_jenis_hp.jenis_hp_id', '=', 'jenis_hp.jenis_id')
                ->whereIn('detail_teknisi_jenis_hp.jenis_hp_id', $jenisHpRaw)
                ->orWhereIn('detail_teknisi_jenis_kerusakan_hp.jenis_kerusakan_hp_id', $jenisKerusakanRaw)
                ->orderBy('teknisi.teknisi_total_score', 'asc')
                ->orderBy('teknisi.teknisi_total_responden', 'asc')
                ->groupBy('detail_teknisi_jenis_hp.teknisi_id', 'detail_teknisi_jenis_kerusakan_hp.teknisi_id')
                ->get();

            if (sizeof($teknisiSearch) >= 0) {
                return response()->json([
                    'code' => 200,
                    'status' => "SUCCESS",
                    'message' => 'Data berhasil diambil!',
                    'result' => $teknisiSearch,
                ], 200);
            }
            else{
                return response()->json([
                    'code' => 200,
                    'status' => "SUCCESS",
                    'message' => 'Data kosong!',
                    'result' => $teknisiSearch,
                ], 200);
            }

        }
        catch (QueryException $exception){
            return response()->json([
                'code' => 500,
                'status' => "FAILED",
                'message' => $exception->getMessage(),
                'result' => "",
            ], 500);
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
                'code' => 421,
                'message' => 'FAILED, user sudah ada',
            ], 421);
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
                            'code' => 200,
                            'message' => 'Post Berhasil Disimpan!',
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'code' => 400,
                            'message' => 'FAILED',
                        ], 400);
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
                            'code' => 201,
                            'message' => 'Post Berhasil Disimpan!',
                        ], 200);
                    }
                    else
                    {
                        return response()->json([
                            'code' => 404,
                            'message' => 'FAILED',
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
//                    $teknisi->teknisi_total_score = $request->teknisi_total_score;
//                    $teknisi->teknisi_total_responden = $request->teknisi_total_responden;
                    $teknisi->teknisi_deskripsi = $request->teknisi_deskripsi;
                    $teknisi->save();
                }

                if ($users && $teknisi)
                {
                    return response()->json([
                        'code' => 201,
                        'message' => 'SUCCESS',
                    ], 200);
                }
                else
                {
                    return response()->json([
                        'code' => false,
                        'message' => 'FAILED',
                    ], 404);
                }
            }
        }
    }


    public function insert_teknisi_jenis_hp_keahlian()
    {
        $rawData = json_decode(file_get_contents("php://input"), true);
        $deskripsi = $rawData['deskripsi'];
        $teknisi_id = $rawData['teknisi_id'];
        $dataJenisHp = $rawData['jenis_hp'];
        $dataJenisKerusakanHp = $rawData['jenis_kerusakan_hp'];

        $teknisiJenisHp = new TeknisiJenisHp();
        $teknisiJenisHp->deskripsi = $deskripsi;
        $teknisiJenisHp->teknisi_id = $teknisi_id;
        $teknisiJenisHp->save();

        for($size = 0; $size < sizeof($dataJenisHp); $size++){
            $detailTeknisiJenisHp = DB::table('detail_teknisi_jenis_hp')->insert(
            [
                'teknisi_jenis_hp_id' => $teknisiJenisHp['id'],
                'jenis_hp_id' => $dataJenisHp[$size]['jenis_hp_id'],
                'teknisi_id' => $teknisi_id
            ]);
        }

        $teknisiJenisKerusakanHp = new TeknisiKerusakanJenisHp();
        $teknisiJenisKerusakanHp->deskripsi = $deskripsi;
        $teknisiJenisKerusakanHp->teknisi_id = $teknisi_id;
        $teknisiJenisKerusakanHp->save();

        for($size = 0; $size < sizeof($dataJenisKerusakanHp); $size++){
            $detailTeknisiJenisKerusakanHp = DB::table('detail_teknisi_jenis_kerusakan_hp')->insert(
                [
                    'teknisi_kerusakan_jenis_hp_id' => $teknisiJenisKerusakanHp['id'],
                    'jenis_kerusakan_hp_id' => $dataJenisKerusakanHp[$size]['kerusakan_jenis_hp_id'],
                    'teknisi_id' => $teknisi_id
                ]
            );
        }

        if($teknisiJenisKerusakanHp && $detailTeknisiJenisHp && $detailTeknisiJenisKerusakanHp){
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Post Berhasil Disimpan!',
                'result' => "",
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 400,
                'status' => "FAILED",
                'message' => 'Post Gagal Disimpan!',
                'result' => "",
            ], 400);
        }


    }

    public function update_teknisi($id){

        $rawData = json_decode(file_get_contents("php://input"), true);

        $userRaw = $rawData['user'];
        $teknisiRaw = $rawData['teknisi'];
        $dataJenisHp = $rawData['jenis_hp'];
        $dataJenisKerusakanHp = $rawData['jenis_kerusakan_hp'];

        try {
            $user = User::find($userRaw['id']);
            $user->name = $userRaw['nama'];
            $user->save();

            if ($user){
                $teknisi = Teknisi::find($teknisiRaw['teknisi_id']);

                $teknisi->email = $user['email'];
                $teknisi->teknisi_hp = $user['no_hp'];
                $teknisi->teknisi_nama = $userRaw['nama'];
                $teknisi->teknisi_nama_toko = $teknisiRaw['nama_toko'];
                $teknisi->teknisi_alamat =$teknisiRaw['teknisi_alamat'];
                $teknisi->teknisi_deskripsi = $teknisiRaw['deskripsi'];
                //$teknisi->teknisi_lat = $user['lat'];
                //$teknisi->teknisi_lng = $user['lng'];
                $teknisi->save();

                DB::table('detail_teknisi_jenis_hp')
                    ->where('teknisi_id', '=', $teknisiRaw['teknisi_id'])
                    ->delete();

                DB::table('detail_teknisi_jenis_kerusakan_hp')
                    ->where('teknisi_id', '=', $teknisiRaw['teknisi_id'])
                    ->delete();

                for($size = 0; $size < sizeof($dataJenisHp); $size++){
                    $detailTeknisiJenisHp = DB::table('detail_teknisi_jenis_hp')->insert(
                        [
                            'teknisi_jenis_hp_id' => $dataJenisHp[$size]['id'],
                            'jenis_hp_id' => $dataJenisHp[$size]['jenis_hp_id'],
                            'teknisi_id' => $teknisiRaw['teknisi_id']
                        ]);
                }


                for($size = 0; $size < sizeof($dataJenisKerusakanHp); $size++){
                    $detailTeknisiJenisKerusakanHp = DB::table('detail_teknisi_jenis_kerusakan_hp')->insert(
                        [
                            'teknisi_kerusakan_jenis_hp_id' => $dataJenisKerusakanHp[$size]['id'],
                            'jenis_kerusakan_hp_id' => $dataJenisKerusakanHp[$size]['kerusakan_jenis_hp_id'],
                            'teknisi_id' =>$teknisiRaw['teknisi_id']
                        ]
                    );
                }

                return response()->json([
                    'code' => 200,
                    'status' => "SUCCESS",
                    'message' => 'Berhasil Diupdate!',
                    'result' => "",
                ], 200);
            }
        }
        catch (QueryException $exception) {
            return response()->json([
                'code' => 400,
                'status' => "FAILED",
                'message' => $exception->getMessage(),
                'result' => "",
            ], 400);
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

    public function get_keahlian_teknisi_by($teknisi_id)
    {
        $jenisKerusakanSearch = DB::table('detail_teknisi_jenis_kerusakan_hp')
            ->select('detail_teknisi_jenis_kerusakan_hp.*', 'teknisi.teknisi_nama', 'jenis_kerusakan_hp.nama_kerusakan')
            ->join('teknisi_kerusakan_jenis_hp', 'teknisi_kerusakan_jenis_hp.id', '=', 'detail_teknisi_jenis_kerusakan_hp.teknisi_kerusakan_jenis_hp_id')
            ->join('teknisi', 'teknisi.teknisi_id', '=', 'teknisi_kerusakan_jenis_hp.teknisi_id')
            ->join('jenis_kerusakan_hp', 'detail_teknisi_jenis_kerusakan_hp.jenis_kerusakan_hp_id', '=', 'jenis_kerusakan_hp.id_jenis_kerusakan')
            ->where('teknisi_kerusakan_jenis_hp.teknisi_id', '=', $teknisi_id)
            ->groupBy('detail_teknisi_jenis_kerusakan_hp.jenis_kerusakan_hp_id')
            ->orderBy('jenis_kerusakan_hp.nama_kerusakan', 'ASC')
            ->get();

        $jenisHpSearch = DB::table('detail_teknisi_jenis_hp')
            ->select( 'jenis_hp.*', 'detail_teknisi_jenis_hp.*')
            ->join('teknisi_jenis_hp', 'teknisi_jenis_hp.id', '=', 'detail_teknisi_jenis_hp.teknisi_jenis_hp_id')
            ->join('jenis_hp', 'detail_teknisi_jenis_hp.jenis_hp_id', '=', 'jenis_hp.jenis_id')
            ->where('teknisi_jenis_hp.teknisi_id', '=', $teknisi_id)
            ->groupBy('detail_teknisi_jenis_hp.jenis_hp_id')
            ->orderBy('jenis_hp.jenis_nama', 'ASC')
            ->get();

        if (sizeof($jenisKerusakanSearch) >= 0 && sizeof($jenisHpSearch) >= 0) {
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Data berhasil diambil!',
                'result' => [
                    'jenis_kerusakan' => $jenisKerusakanSearch,
                    'jenis_hp' => $jenisHpSearch
                ]
            ], 200);
        }else{
            return response()->json([
                'code' => 400,
                'status' => "SUCCESS",
                'message' => 'Data gagal diambil!',
                'result' => "",
            ], 400);
        }
    }

    public function update_user_teknisi()
    {
        // TODO reference TPA API
        $rawData = json_decode(file_get_contents("php://input"), true);
        $deskripsi = $rawData['deskripsi'];
        $teknisi_id = $rawData['teknisi_id'];
        $dataJenisHp = $rawData['jenis_hp'];
        $dataJenisKerusakanHp = $rawData['jenis_kerusakan_hp'];

        $teknisiJenisKerusakanHp = new TeknisiJenisHp();
        $teknisiJenisKerusakanHp->deskripsi = $deskripsi;
        $teknisiJenisKerusakanHp->teknisi_id = $teknisi_id;
        $teknisiJenisKerusakanHp->save();

        for($size = 0; $size < sizeof($dataJenisHp); $size++){
            $detailTeknisiJenisHp = DB::table('detail_teknisi_jenis_hp')->insert(
                [
                    'teknisi_kerusakan_jenis_hp_id' => $teknisiJenisKerusakanHp['id'],
                    'jenis_hp_id' => $dataJenisHp[$size]['jenis_hp_id']
                ]);
        }


        for($size = 0; $size < sizeof($dataJenisKerusakanHp); $size++){
            $detailTeknisiJenisKerusakanHp = DB::table('detail_teknisi_jenis_kerusakan_hp')->insert(
                [
                    'teknisi_kerusakan_jenis_hp_id' => $teknisiJenisKerusakanHp['id'],
                    'jenis_kerusakan_hp_id' => $dataJenisKerusakanHp[$size]['kerusakan_jenis_hp_id']
                ]
            );
        }

        if($teknisiJenisKerusakanHp && $detailTeknisiJenisHp && $detailTeknisiJenisKerusakanHp){
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Post Berhasil Disimpan!',
                'result' => "",
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 400,
                'status' => "FAILED",
                'message' => 'Post Gagal Disimpan!',
                'result' => "",
            ], 400);
        }


    }

    public function update_teknisi_foto(Request $request) {

        $teknisi_table = DB::table('teknisi')
            ->where('teknisi_id', '=', $request->teknisi_id)->first();

        if (!$teknisi_table) {
            return response()->json([
                'code' => 404,
                'message' => 'Teknisi tidak ditemukan!',
            ], 404);
        }

        $teknisi_photo = $request->file('teknisi_foto');
        $teknisi_photo_name = $teknisi_table->teknisi_nama.'_'.$teknisi_photo->getClientOriginalName();

        $teknisi = DB::table('teknisi')
            -> where('teknisi_id', '=', $request->teknisi_id)
            -> update([
                'teknisi_foto' => $teknisi_photo_name
            ]);

        $teknisi_photo->move(public_path('foto-teknisi'), $teknisi_photo_name);

        if ($teknisi)
        {
            return response()->json([
                'code' => 200,
                'message' => 'Photo teknisi berhasil diupdate!',
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function update_teknisi_sertifikat(Request $request) {

        $teknisi_table = DB::table('teknisi')
            ->where('teknisi_id', '=', $request->teknisi_id)->first();

        if (!$teknisi_table) {
            return response()->json([
                'code' => 404,
                'message' => 'Teknisi tidak ditemukan!',
            ], 404);
        }

        $teknisi_sertifikat = $request->file('teknisi_sertifikat');
        $teknisi_sertifikat_name = $teknisi_table->teknisi_nama.'_'.$teknisi_sertifikat->getClientOriginalName();

        $teknisi = DB::table('teknisi')
            -> where('teknisi_id', '=', $request->teknisi_id)
            -> update([
                'teknisi_sertifikat' => $teknisi_sertifikat_name
            ]);

        $teknisi_sertifikat->move(public_path('foto-sertifikat'), $teknisi_sertifikat_name);

        if ($teknisi)
        {
            return response()->json([
                'code' => 200,
                'message' => 'Photo teknisi berhasil diupdate!',
            ], 200);
        }
        else
        {
            return response()->json([
                'code' => 500,
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

}
