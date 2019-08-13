<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MaxAtributo;

/**
 * Class MaxAtributoTransformer.
 *
 * @package namespace App\Transformers;
 */
class MaxAtributoTransformer extends TransformerAbstract
{
    /**
     * Transform the MaxAtributo entity.
     *
     * @param \App\Entities\MaxAtributo $model
     *
     * @return array
     */
    public function transform(MaxAtributo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
