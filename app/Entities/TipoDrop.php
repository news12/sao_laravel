<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TipoDrop.
 *
 * @package namespace App\Entities;
 */
class TipoDrop extends Model implements Transformable
{
    use TransformableTrait;

    protected
        $table = 'tipo_drops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cod_drop',
        'nome',
        'status'
    ];

}
