<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Rank;

/**
 * Class RankTransformer.
 *
 * @package namespace App\Transformers;
 */
class RankTransformer extends TransformerAbstract
{
    /**
     * Transform the Rank entity.
     *
     * @param \App\Entities\Rank $model
     *
     * @return array
     */
    public function transform(Rank $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
