<?php
/**
 * Created by PhpStorm.
 * User: Uerley
 * Date: 02/01/2019
 * Time: 12:47
 */

namespace App\Http\ViewComposersSao;
use App\Repositories\SaoRepository;
use Illuminate\View\View;
class ViewComposersSao {
    protected $rota;
    public function __construct(SaoRepository $rota) {
        $this->rota = $rota;
    }
    public function compose(View $view)
    {

        $sessao_conta = $this->rota->composerPerso();
        $view->with(compact('sessao_conta'));
    }
}