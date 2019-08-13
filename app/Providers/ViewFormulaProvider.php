<?php

namespace App\Providers;

use App\Entities\Personagem;
use App\Repositories\PersonagemRepository;
use App\Repositories\PersonagemRepositoryEloquent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\This;

class ViewFormulaProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     *
     */
    private $str;
    private $str_width;
    private $int;
    private $int_width;
    private $agi;
    private $agi_width;
    private $def;
    private $def_width;
    private $res;
    private $res_width;
    private $vit;
    private $vit_width;
    private $esp;
    private $esp_width;
    private $mag;
    private $mag_width;
    private $evo;
    private $evo_width;
    private $dano_magico;
    private $dano_fisico;
    private $dano_evoc;
    private $defesa;
    private $resistencia;
    private $item_dano_magico;
    private $item_dano_fisico;
    private $item_dano_evoc;
    private $item_defesa;
    private $item_resistencia;
    private $item_vida;
    private $extra;
    private $item_extra;
    private $power;
    private $power_item;
    private $power_personagem;
    private $posicao;
    private $rank_atual;
    private $equipe;
    private $critico;
    private $item_critico;
    private $esquiva;
    private $item_esquiva;
    private $bloqueio;
    private $item_bloqueio;
    private $personagem;


    public function boot()
    {
        /*$this->personagem = $personagem->personagem_status();
        dd($this->personagem);*/
        View::composer('*', function ($view) {
            //pagina de status do personagem
            $max_atributos_id = 1;
            $status_personagem = DB::table('personagems')
                ->select('personagems.*', 'classes.classe', 'levels.level as max_level',
                    'levels.cols as rec_cols', 'levels.exp as max_exp',
                    'levels.hp as rec_hp', 'levels.energia as rec_energia', 'avatars.avatar as avatar',
                    'guilds.guild', 'guilds.sigla', 'andars.andar', 'equipes.nome as equipe')
                ->join('classes', 'personagems.id_classe', 'classes.id')
                ->join('levels', 'personagems.level', '=', 'levels.id')
                ->join('avatars', 'personagems.id_avatar', '=', 'avatars.id')
                ->leftJoin('guilds', 'personagems.id_guild', '=', 'guilds.id')
                ->leftJoin('andars', 'personagems.id_andar', '=', 'andars.id')
                ->leftJoin('equipes', 'personagems.id_equipe', '=', 'equipes.id')
                ->where('conta', '=', Auth::id())
                ->where('ativo', '=', '1')
                ->get();
            $max_atributos = DB::table('max_atributos')
                ->select('*')
                ->where('id', '=', $max_atributos_id)
                ->get();

            $this->rank_atual = 0;


            foreach ($status_personagem as $status) {
                foreach ($max_atributos as $atributo) {

                    if (empty($atributo->equipe)) {
                        $this->equipe = 'Nenhuma';
                    } else {
                        $this->equipe = $atributo->equipe;
                    }
                    $status_itens = DB::table('mochilas')
                        ->select('mochilas.id_personagem',
                            DB::raw('sum(items.poder_fisico) as poder_fisico'),
                            DB::raw('sum(items.poder_magico) as poder_magico'),
                            DB::raw('sum(items.poder_evocacao) as poder_evocacao'),
                            DB::raw('sum(items.poder) as item_poder'),
                            DB::raw('sum(items.critico) as critico'),
                            DB::raw('sum(items.esquiva) as esquiva'),
                            DB::raw('sum(items.bloqueio) as bloqueio'),
                            DB::raw('sum(items.res) as res'),
                            DB::raw('sum(items.vida) as vida'),
                            DB::raw('sum(items.def) as def'))
                        ->join('items', 'mochilas.id_item', '=', 'items.id')
                        ->where('id_personagem', '=', $status->id)
                        ->where('status', '>', 0)
                        ->where('status', '<', 15)
                        ->groupBy('id_personagem')
                        ->get();
                    //verifica posição por level
                    $ranking_level = DB::table('personagems')
                        ->select('*')
                        ->where('level', '>', $status->level)
                        ->count('id');
                    //desempate por xp
                    $ranking_xp = DB::table('personagems')
                        ->select('*')
                        ->where('level', '=', $status->level)
                        ->where('exp', '>', $status->exp)
                        ->count('id');
                    //desempate por id
                    $ranking_id = DB::table('personagems')
                        ->select('*')
                        ->where('level', '=', $status->level)
                        ->where('exp', '=', $status->exp)
                        ->where('id', '<', $status->id)
                        ->count('id');

                    $this->posicao = $ranking_level + $ranking_xp + $ranking_id + 1;
                    $this->rank_atual = $this->posicao;


                    //--Formula % força--
                    $this->str = ($status->forca / $atributo->max_for) * 100;
                    $this->str_width = (250 * $this->str) / 100;
                    //-- Formula % inteligencia--
                    $this->int = ($status->inteligencia / $atributo->max_int) * 100;
                    $this->int_width = (250 * $this->int) / 100;
                    //-- Formula % agilidade--
                    $this->agi = ($status->agilidade / $atributo->max_agi) * 100;
                    $this->agi_width = (250 * $this->agi) / 100;
                    //-- Formula % defesa--
                    $this->def = ($status->defesa / $atributo->max_def) * 100;
                    $this->def_width = (250 * $this->def) / 100;
                    //-- Formula % resistencia--
                    $this->res = ($status->resistencia / $atributo->max_res) * 100;
                    $this->res_width = (250 * $this->res) / 100;
                    //-- Formula % vitalidade--
                    $this->vit = ($status->vitalidade / $atributo->max_vit) * 100;
                    $this->vit_width = (250 * $this->vit) / 100;
                    //-- Formula % espada--
                    $this->esp = ($status->espada / $atributo->max_esp) * 100;
                    $this->esp_width = (250 * $this->esp) / 100;
                    //-- Formula % magia--
                    $this->mag = ($status->magia / $atributo->max_mag) * 100;
                    $this->mag_width = (250 * $this->mag) / 100;
                    //-- Formula % evocação--
                    $this->evo = ($status->evoc / $atributo->max_evo) * 100;
                    $this->evo_width = (250 * $this->evo) / 100;

                    foreach ($status_itens as $attr_itens) {

                        //-- Formula ataque magico--
                        $this->item_dano_magico = $attr_itens->poder_magico;

                        //-- Formula ataque fisico--
                        $this->item_dano_fisico = $attr_itens->poder_fisico;

                        //-- Formula ataque evocação--
                        $this->item_dano_evoc = $attr_itens->poder_evocacao;

                        //-- Formula defesa--
                        $this->item_defesa = $attr_itens->def;

                        //-- Formula resistencia--
                        $this->item_resistencia = $attr_itens->res;

                        //-- Formula hp--
                        $this->item_vida = $attr_itens->vida;

                        // extra
                        $this->item_extra = ($this->item_vida + $this->item_resistencia + $this->item_defesa) / 5;

                        //esquiva
                        $this->item_esquiva = $attr_itens->esquiva;

                        //bloqueio
                        $this->item_bloqueio = $attr_itens->bloqueio;

                        //critico
                        $this->item_critico = $attr_itens->critico;

                        // formula poder item
                        $this->power_item = $this->item_dano_magico + $this->item_dano_fisico + $this->item_dano_evoc +
                            $this->item_extra + $this->item_esquiva + $this->item_critico + $this->item_bloqueio;

                    }
                    //-- Formula ataque magico--
                    $this->dano_magico = $status->poder_magico;

                    //-- Formula ataque fisico--
                    $this->dano_fisico = $status->poder_fisico;

                    //-- Formula ataque evocação--
                    $this->dano_evoc = $status->poder_evocacao;

                    //esquiva
                    $this->esquiva = $status->esquiva;

                    //critico
                    $this->critico = $status->critico;

                    //bloqueio
                    $this->bloqueio = $status->bloqueio;

                    //-- Formula defesa--
                    $this->defesa = $status->defesa;

                    //-- Formula resistencia--
                    $this->resistencia = $status->resistencia;

                    //-- Formula extra--
                    $this->extra = (($status->vitalidade * 10) + $status->vida + $this->resistencia + $this->defesa) / 5;


                    //-- Formula % poder persomagem--
                    $this->power_personagem = $this->dano_magico + $this->dano_fisico + $this->dano_evoc + $this->extra
                        + $this->esquiva + $this->critico + $this->bloqueio;
                }
                $this->power = $this->power_personagem + $this->power_item;
            }

            $formula_colecion = collect([
                'str' => $this->str,
                'str_width' => $this->str_width,
                'int' => $this->int,
                'int_width' => $this->str_width,
                'agi' => $this->agi,
                'agi_width' => $this->agi_width,
                'def' => $this->def,
                'def_width' => $this->def_width,
                'res' => $this->res,
                'res_width' => $this->res_width,
                'vit' => $this->vit,
                'vit_width' => $this->vit_width,
                'esp' => $this->esp,
                'esp_width' => $this->esp_width,
                'mag' => $this->mag,
                'mag_width' => $this->mag_width,
                'evo' => $this->evo,
                'evo_width' => $this->evo_width,
                'dano_magico' => $this->dano_magico,
                'dano_fisico' => $this->dano_fisico,
                'dano_evoc' => $this->dano_evoc,
                'esquiva' => $this->esquiva,
                'critico' => $this->critico,
                'bloqueio' => $this->bloqueio,
                'defesa' => $this->defesa,
                'resistencia' => $this->resistencia,
                'power_item' => $this->power_item,
                'item_dano_fisico' => $this->item_dano_fisico,
                'item_dano_magico' => $this->item_dano_magico,
                'item_dano_evoc' => $this->item_dano_evoc,
                'item_critico' => $this->item_critico,
                'item_defesa' => $this->item_defesa,
                'item_esquiva' => $this->item_esquiva,
                'item_resistencia' => $this->item_resistencia,
                'item_bloqueio' => $this->item_bloqueio,
                'power_personagem' => $this->power_personagem

            ]);


            $view->with('formula', $formula_colecion)
                ->with('status_personagem', $status_personagem)
                ->with('max_atributos', $max_atributos)
                ->with('ranking', $this->rank_atual)
                ->with('equipe_jogador', $this->equipe)
                ->with('power', $this->power);
            /*  dd($formula_colecion);*/

        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*  $this->app->bind(
              PersonagemRepository::class, PersonagemRepositoryEloquent::class
          );*/
    }
}
