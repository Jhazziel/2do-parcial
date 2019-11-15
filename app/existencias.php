<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class existencias extends Model
{
    //
    protected $fillable = [
        'idArticulo', 'idFabrica', 'cantidad',
    ];

    public $timestamps = false;
}
