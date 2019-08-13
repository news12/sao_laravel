<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Andar.
 *
 * @package namespace App\Entities;
 */
class Andar extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'andar',
        'status',
        'id_conquest',
        'level',
        'id_boss',
        'id_team_conquest',
        'id_guild_conquest',
        'boss_vivo',
    ];

}
