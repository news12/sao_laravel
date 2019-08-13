<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PersonagemSkill.
 *
 * @package namespace App\Entities;
 */
class PersonagemSkill extends Model implements Transformable
{
    use TransformableTrait;

    protected
        $table = 'personagem_skill';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_skill',
        'id_personagem',
        'status'
    ];

}
