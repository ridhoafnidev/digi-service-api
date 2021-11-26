<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = false;
    protected $table = 'jual';
    protected $primaryKey = 'jual_id';
}
