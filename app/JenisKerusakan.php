<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKerusakan extends Model
{
    protected $table = 'jenis_kerusakan_hp';
    protected $primaryKey = 'id_jenis_kerusakan';

    public function getJenisKerusakan()
    {
        return $this->get();
    }
    public function getJenisKerusakanBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->first();
    }
    public function getJenisKerusakanOneBy($reference,$value)
    {
        return $this->where($reference,$value)
            ->get();
    }
}
