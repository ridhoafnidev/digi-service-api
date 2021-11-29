<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    public $timestamps = false;
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';

    public function getPelanggan()
    {
        return $this->orderBy('pelanggan_date_created','DESC')
            ->get();
    }
    public function getPelangganBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->first();
    }
}
