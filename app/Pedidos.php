<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    //
    protected $fillable = [
        'id', 'fecha', 'idDireccion',
    ];

    public $timestamps = false;
}
