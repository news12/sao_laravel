<?php

namespace App\Presenters;

use App\Transformers\MaxAtributoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MaxAtributoPresenter.
 *
 * @package namespace App\Presenters;
 */
class MaxAtributoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MaxAtributoTransformer();
    }
}
