<?php

namespace App\Presenters;

use App\Transformers\MochilaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MochilaPresenter.
 *
 * @package namespace App\Presenters;
 */
class MochilaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MochilaTransformer();
    }
}
