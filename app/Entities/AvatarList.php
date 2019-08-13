<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AvatarList.
 *
 * @package namespace App\Entities;
 */
class AvatarList extends Model implements Transformable
{
    use TransformableTrait;

    protected
        $table = 'avatar_lists';

    protected $fillable = [
        'id_avatar',
        'numero_avatar',
        'tipo',
        'status'
    ];

}
