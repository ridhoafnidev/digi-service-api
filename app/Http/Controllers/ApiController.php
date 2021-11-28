<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ApiController extends Controller
{

    private $User;
    private $Token;
    public function __construct()
    {

        $this->User = new User();
        $this->Token = 'VAdQGEvVfX';

    }
    public function list()
    {
        $data['api'] = DB::table('api')
            ->orderBy('api_nama','ASC')
            ->get();
        return view('api/index',$data);
    }
    public function add_api(Request $request){
        DB::table('api')->insert([
            'api_nama' => $request->api_nama,
            'api_link' => $request->api_link,
        ]);
        return redirect('list-api');
    }

    public function user_all($token)
    {
//        var_dump($token);exit();
        if ($this->Token == $token){
            $data = $this->User->getUsers();
            if ($data) {
                echo json_encode(array('kode'=> 1,'result' => $data));
            }else{
                echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
            }
        }else{
                echo json_encode(array('kode'=> 3,'pesan' => 'Akses ditolak !'));
        }
    }
    public function users_by($token,$reference,$value)
    {
//        var_dump($token);exit();
        if ($this->Token == $token){
            $data = $this->User->getUsersBy($reference,$value);
            if ($data) {
                echo json_encode(array('kode'=> 1,'result' => $data));
            }else{
                echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
            }
        }else{
            echo json_encode(array('kode'=> 3,'pesan' => 'Akses ditolak !'));
        }
    }
    public function user_one_by($token,$reference,$value)
    {
        if ($this->Token == $token){
            $data = $this->User->getOneUserBy($reference,$value);
            if ($data) {
                echo json_encode(array('kode'=> 1,'result' => $data));
            }else{
                echo json_encode(array('kode'=> 2,'pesan' => 'data tidak ditemukan'));
            }
        }else{
            echo json_encode(array('kode'=> 3,'pesan' => 'Akses ditolak !'));
        }
    }

    public function get_all_jenis_kerusakan_hp(){
        $jenisHp = DB::table('jenis_hp')->orderBy('jenis_nama', 'ASC')->get();
        $jenisKerusakanHp = DB::table('jenis_kerusakan_hp')->orderBy('nama_kerusakan', 'ASC')->get();
        if (sizeof($jenisHp) > 0){
            return response()->json([
                'code' => 200,
                'status' => "SUCCESS",
                'message' => 'Berhasil diupdate',
                'result' => [
                    'jenis_kerusakan' => $jenisKerusakanHp,
                    'jenis_hp' => $jenisHp
                ],
            ], 200);
        }
    }

}
