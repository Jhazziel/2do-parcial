<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //
    protected $fillable = [
        'id', 'nombre', 'saldo', 'limiteCredito', 'descuento', 'activo',
    ];

    public $timestamps = false;
}
