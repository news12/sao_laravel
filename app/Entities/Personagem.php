<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


/**
 * Class Personagem.
 *
 * @package namespace App\Entities;
 */
class Personagem extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'VipExp',
        'npersonagem',
        'avatar',
        'classificacao',
        'nome',
        'x',
        'y',
        'cols',
        'cidade',
        'nivel',
        'vida',
        'vida_m',
        'exp',
        'energia',
        'energia_m',
        'img_avatar'
    ];

}
