<?php

namespace App\Presenters;

use App\Transformers\AndarTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AndarPresenter.
 *
 * @package namespace App\Presenters;
 */
class AndarPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AndarTransformer();
    }
}
