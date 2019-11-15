<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticulosPedido extends Model
{
    //
    protected $fillable = [
        'idArticulo', 'idPedido', 'cantidad',
    ];

    public $timestamps = false;
}
