<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Mochila;

/**
 * Class MochilaTransformer.
 *
 * @package namespace App\Transformers;
 */
class MochilaTransformer extends TransformerAbstract
{
    /**
     * Transform the Mochila entity.
     *
     * @param \App\Entities\Mochila $model
     *
     * @return array
     */
    public function transform(Mochila $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
