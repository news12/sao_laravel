<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noti_aviso extends Model
{
    protected $fillable = [
        'player',
        'texto',
        'status',
        'data'
    ];

}
