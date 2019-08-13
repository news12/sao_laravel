<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Quest.
 *
 * @package namespace App\Entities;
 */
class Quest extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'level',
        'guild',
        'boss',
        'status',
        'cols',
        'exp',
        'itens',
        'andar'

    ];

}
