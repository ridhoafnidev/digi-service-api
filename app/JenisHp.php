<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisHp extends Model
{
    protected $table = 'jenis_hp';
    protected $primaryKey = 'jenis_id';

    public function getJenisHp()
    {
        return $this->get();
    }
    public function getJenisHpBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->first();
    }
    public function getJenisHpOneBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->get();
    }
}
