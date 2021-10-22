<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisi';
    protected $primaryKey = 'teknisi_id';

    public function getTeknisi()
    {
        return $this->orderBy('created_at','DESC')
            ->get();
    }
    public function getTeknisiBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->first();
    }
    public function getTeknisiOneBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->get();
    }
}
