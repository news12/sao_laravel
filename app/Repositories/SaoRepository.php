<?php
/**
 * Created by PhpStorm.
 * User: Uerley
 * Date: 02/01/2019
 * Time: 12:49
 */
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaoRepository {

    public function composerPerso(): \Illuminate\Support\Collection
    {
        $sessao_conta = DB::table('personagems')
            ->select('personagems.*','classes.classe','levels.level as max_level',
                'levels.cols as rec_cols','levels.exp as max_exp',
                'levels.hp as rec_hp','levels.energia as rec_energia')
            ->join('classes','personagems.id_classe','classes.id')
            ->join('levels','personagems.level','=','levels.id')
            ->where('conta','=',Auth::id())
            ->where('ativo','=','1')
            ->limit(1)
            ->get();
        return $sessao_conta;
    }
}
