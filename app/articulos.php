<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articulos extends Model
{
    //
    protected $fillable = [
        'id', 'descripcion',
    ];

    public $timestamps = false;
}
