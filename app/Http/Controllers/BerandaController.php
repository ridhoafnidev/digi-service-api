<?php

namespace App\Http\Controllers;

use App\JenisHp;
use App\Pelanggan;
use App\Teknisi;

class BerandaController extends Controller{
    public function __construct()
    {
        $this->Teknisi = new Teknisi();
        $this->Pelanggan = new Pelanggan();
        $this->JenisHp = new JenisHp();

    }
    public function index(){
        $data['teknisi'] = sizeof($this->Teknisi->getTeknisi());
        $data['pelanggan'] = sizeof($this->Pelanggan->getPelanggan());
        $data['jenis_hp'] = sizeof($this->JenisHp->getJenisHp());


        return view('beranda/index', $data);
    }
}
