<?php

namespace App\Presenters;

use App\Transformers\ClasseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClassePresenter.
 *
 * @package namespace App\Presenters;
 */
class ClassePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClasseTransformer();
    }
}
