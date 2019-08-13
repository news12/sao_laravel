<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PersonagemSkill;

/**
 * Class SkillPersonagemTransformer.
 *
 * @package namespace App\Transformers;
 */
class SkillPersonagemTransformer extends TransformerAbstract
{
    /**
     * Transform the PersonagemSkill entity.
     *
     * @param \App\Entities\PersonagemSkill $model
     *
     * @return array
     */
    public function transform(PersonagemSkill $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
