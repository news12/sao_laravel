<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Classe.
 *
 * @package namespace App\Entities;
 */
class Classe extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'classe',
        'inteligencia',
        'forca',
        'defesa',
        'resistencia',
        'level',
        'status'
    ];

}
