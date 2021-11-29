<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    public $timestamps = false;
    protected $table = 'beli';
    protected $primaryKey = 'beli_id';
}
