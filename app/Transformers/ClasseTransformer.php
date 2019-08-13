<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Classe;

/**
 * Class ClasseTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClasseTransformer extends TransformerAbstract
{
    /**
     * Transform the Classe entity.
     *
     * @param \App\Entities\Classe $model
     *
     * @return array
     */
    public function transform(Classe $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
