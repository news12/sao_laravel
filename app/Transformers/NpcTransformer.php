<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Npc;

/**
 * Class NpcTransformer.
 *
 * @package namespace App\Transformers;
 */
class NpcTransformer extends TransformerAbstract
{
    /**
     * Transform the Npc entity.
     *
     * @param \App\Entities\Npc $model
     *
     * @return array
     */
    public function transform(Npc $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
