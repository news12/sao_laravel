<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Equipe.
 *
 * @package namespace App\Entities;
 */
class Equipe extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'min_membros',
        'max_membros',
        'nome',
        'sigla',
        'id_lider',
        'level',
        'level_min',
        'level_max',
    ];

}
