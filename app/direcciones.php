<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class direcciones extends Model
{
    //
    protected $fillable = [
        'id', 'calle', 'comuna', 'ciudad', 'idCliente',
    ];

    public $timestamps = false;
}
