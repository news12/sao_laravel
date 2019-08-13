<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MaxAtributo.
 *
 * @package namespace App\Entities;
 */
class MaxAtributo extends Model implements Transformable
{
    use TransformableTrait;

    protected
        $table = 'max_atributos';


    protected $fillable = [
        'max_for',
        'max_int',
        'max_agi',
        'max_def',
        'max_res',
        'max_dan',
        'max_hp',
        'max_ene',
        'max_cols',
        'max_level',
        'max_guild_member',
        'max_guilds',
        'max_player',
        'max_quest',
        'max_vit',
        'max_esp',
        'max_mag',
        'max_evo',
        'max_cash',
        'max_slot',
        'max_slot_vip',
        'max_avatar',
        'max_avatar_vip'
    ];

}
