<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Equipe;

/**
 * Class EquipeTransformer.
 *
 * @package namespace App\Transformers;
 */
class EquipeTransformer extends TransformerAbstract
{
    /**
     * Transform the Equipe entity.
     *
     * @param \App\Entities\Equipe $model
     *
     * @return array
     */
    public function transform(Equipe $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
