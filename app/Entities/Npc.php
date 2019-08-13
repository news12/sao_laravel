<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Npc.
 *
 * @package namespace App\Entities;
 */
class Npc extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'descricao',
        'titulo',
        'tipo',
        'id_equipe',
        'id_guild',
        'img_avatar',
        'mapa',
        'x',
        'y',
        'id_classe',
        'cidade',
        'ponto_atributo',
        'cols',
        '_ticket',
        'level',
        'vida',
        'vida_m',
        'energia',
        'energia_m',
        'eng',
        'exp',
        'forca',
        'defesa',
        'agilidade',
        'inteligencia',
        'resistencia',
        'vitalidade',
        'espada',
        'magia',
        'evoc',
        'ponto',
        'ponto_tecnica',
        'rank_D',
        'rank_C',
        'rank_B',
        'rank_A',
        'rank_S'

    ];

}
