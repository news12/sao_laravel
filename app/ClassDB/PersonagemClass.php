<?php
/**
 * Created by PhpStorm.
 * User: Uerley
 * Date: 01/01/2019
 * Time: 16:17
 */

namespace App\ClassDB;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PersonagemClass
{
   private $sessao_conta;
   private $noticias;
   private $noticias_anuncio;
   private $rank_level;
   private $posicao;
   private $user;
   private $avatar;

    /**
     * PersonagemClass constructor.
     * @param PersonagemClass $sessao_contas
     */
    public function __construct(PersonagemClass $sessao_contas)
   {

       $this->sessao_conta = $sessao_contas;
   }


    public function PersonagemClass(): Collection
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