<?php

namespace App\Presenters;

use App\Transformers\NpcTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NpcPresenter.
 *
 * @package namespace App\Presenters;
 */
class NpcPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NpcTransformer();
    }
}
