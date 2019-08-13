<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TipoItem.
 *
 * @package namespace App\Entities;
 */
class TipoItem extends Model implements Transformable
{
    use TransformableTrait;

    protected
        $table = 'tipo_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cod_tipo_item',
        'nome',
        'status'
    ];

}
