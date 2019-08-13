<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $fillable = [
        'titulo',
        'categoria',
        'noticia',
        'data'
    ];
}
