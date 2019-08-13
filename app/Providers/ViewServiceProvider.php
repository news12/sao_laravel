<?php

namespace App\Providers;

use App\Entities\Personagem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    private $avatar;
    private $level_up = false;
    private $exp_sobra;
    private $novo_level;
    public $modal_up_show;

    public function boot()
    {

        View::composer('*', function ($view) {
            //Carrega dados do personagem atual
            $sessao = DB::table('personagems')
                ->select('personagems.*', 'classes.classe', 'levels.level as max_level',
                    'levels.cols as rec_cols', 'levels.exp as max_exp',
                    'levels.hp as rec_hp', 'levels.energia as rec_energia')
                ->join('classes', 'personagems.id_classe', 'classes.id')
                ->join('levels', 'personagems.level', '=', 'levels.id')
                ->where('conta', '=', Auth::id())
                ->where('ativo', '=', '1')
                ->limit(1)
                ->get();

            foreach ($sessao as $up_perso) {
                $exp_atual = $up_perso->exp;
                $exp_max = $up_perso->max_exp;
                if ($exp_atual > $exp_max) {
                    $this->exp_sobra = $exp_atual - $exp_max;
                    $this->level_up = true;
                    $this->modal_up_show = 'on';
                } else if ($exp_atual === $exp_max) {
                    $this->exp_sobra = 0;
                    $this->level_up = true;
                    $this->modal_up_show = 'on';
                } else {
                    $this->level_up = false;
                }
                if ($this->level_up === true) {
                    //Atualiza Status do Personagem
                    $this->novo_level = $up_perso->max_level;
                    DB::table('personagems')
                        ->where('conta', '=', Auth::id())
                        ->where('ativo', '=', '1')
                        ->update([
                            'level' => $up_perso->max_level,
                            'exp' => $this->exp_sobra,
                            'vida' => $up_perso->vida + $up_perso->rec_hp,
                            'vida_m' => $up_perso->vida_m + $up_perso->rec_hp,
                            'energia' => $up_perso->energia + $up_perso->rec_energia,
                            'energia_m' => $up_perso->energia_m + $up_perso->rec_energia,
                            'cols' => $up_perso->cols + $up_perso->rec_cols,
                        ]);
                }
                /*dd($this->exp_sobra);*/

            }

            foreach ($sessao as $personagens) {
                //Carrega dados do avatar com base no select do personagem atual
                $avt = DB::table('avatars')
                    ->select('avatars.*', 'personagems.img_avatar')
                    ->join('personagems', 'avatars.id', '=', 'personagems.id_avatar')
                    ->where('conta', '=', Auth::id())
                    ->where('avatars.id', '=', $personagens->id_avatar)
                    ->where('personagems.id', '=', $personagens->id)
                    ->get();

                $this->avatar = $avt;
            }
            //Carrega anuncios do topo das paginas
            $noticias = DB::table('noti_avisos')
                ->select('personagems.nome as player', 'texto')
                ->join('personagems', 'noti_avisos.id_personagem', '=', 'personagems.id')
                ->where('noti_avisos.status', '=', 1)
                ->get();

            //Carrega usuário logado
            $user = Auth::user();

            $view->with('sessao_conta', $sessao)
                ->with('avatar', $this->avatar)
                ->with('noticias', $noticias)
                ->with('user', $user)
                ->with('new_level', $this->novo_level)
                ->with('level_up_show', $this->modal_up_show);
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /* private function ViewComposersSao() {
         view()->composer('*', 'App\Http\ViewComposersSao');
     }*/
}
