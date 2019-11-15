<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fabricas extends Model
{
    //
    protected $fillable = [
        'id', 'telefono',
    ];

    public $timestamps = false;
}
