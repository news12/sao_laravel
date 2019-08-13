<?php

namespace App\Presenters;

use App\Transformers\EquipeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EquipePresenter.
 *
 * @package namespace App\Presenters;
 */
class EquipePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EquipeTransformer();
    }
}
