<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Andar;

/**
 * Class AndarTransformer.
 *
 * @package namespace App\Transformers;
 */
class AndarTransformer extends TransformerAbstract
{
    /**
     * Transform the Andar entity.
     *
     * @param \App\Entities\Andar $model
     *
     * @return array
     */
    public function transform(Andar $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
