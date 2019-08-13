<?php

namespace App\Providers;

use App\Repositories\AndarRepository;
use App\Repositories\AndarRepositoryEloquent;
use App\Repositories\AvatarListRepository;
use App\Repositories\AvatarListRepositoryEloquent;
use App\Repositories\AvatarRepository;
use App\Repositories\AvatarRepositoryEloquent;
use App\Repositories\ClasseRepository;
use App\Repositories\ClasseRepositoryEloquent;
use App\Repositories\GrauItemRepository;
use App\Repositories\GrauItemRepositoryEloquent;
use App\Repositories\ItemRepository;
use App\Repositories\ItemRepositoryEloquent;
use App\Repositories\MapaRepository;
use App\Repositories\MapaRepositoryEloquent;
use App\Repositories\MaxAtributoRepository;
use App\Repositories\MaxAtributoRepositoryEloquent;
use App\Repositories\MochilaRepository;
use App\Repositories\MochilaRepositoryEloquent;
use App\Repositories\NoticiaRepository;
use App\Repositories\NoticiaRepositoryEloquent;
use App\Repositories\NpcRepository;
use App\Repositories\NpcRepositoryEloquent;
use App\Repositories\PersonagemRepository;
use App\Repositories\PersonagemRepositoryEloquent;
use App\Repositories\QuestRepository;
use App\Repositories\QuestRepositoryEloquent;
use App\Repositories\SkillRepository;
use App\Repositories\SkillRepositoryEloquent;
use App\Repositories\TipoDropRepository;
use App\Repositories\TipoDropRepositoryEloquent;
use App\Repositories\TipoItemRepository;
use App\Repositories\TipoItemRepositoryEloquent;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class SaoProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    private $andar;
    private $localizacao;

    public function boot(Dispatcher $events)
    {
        $this->register();
        Gate::define('menu-admin', function ($user) {
            return $user->conta === 'admin';
        });
        //Menu de mapa criado dinamicamente para pegar dados do banco
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            //Carrega dados do personagem atual
            $sessao_mapa = DB::table('personagems')
                ->select('personagems.*', 'classes.classe', 'levels.level as max_level',
                    'levels.cols as rec_cols', 'levels.exp as max_exp',
                    'levels.hp as rec_hp', 'levels.energia as rec_energia')
                ->join('classes', 'personagems.id_classe', 'classes.id')
                ->join('levels', 'personagems.level', '=', 'levels.id')
                ->where('conta', '=', Auth::id())
                ->where('ativo', '=', '1')
                ->limit(1)
                ->get();

            foreach ($sessao_mapa as $mapa) {
                $this->andar = $mapa->id_andar;
                $this->localizacao = $mapa->cidade;
            }
            $event->menu->add('MAPA');
            $event->menu->add([
                'text' => 'Andar ' . $this->andar . 'º',
                'url' => 'andar',
                'icon' => 'bank',
                'submenu' => [
                    [
                        'text' => 'Local',
                        'url' => 'andar',
                        'icon' => 'bullseye',
                    ],
                    [
                        'text' => 'Resenha',
                        'url' => 'mapa/resenha',
                        'icon' => 'newspaper-o',
                        /* 'can' => 'adminuser',*/
                    ],
                    [
                        'text' => 'Dungeom',
                        'url' => 'mapa/dg',
                        'icon' => 'key'
                    ],
                    ['text' => 'Teleporte',
                        'url' => 'mapa/teleporte',
                        'icon' => 'university',
                    ],
                ],
            ]);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PersonagemRepository::class, PersonagemRepositoryEloquent::class);

        $this->app->bind(
            SkillRepository::class, SkillRepositoryEloquent::class);

        $this->app->bind(
            NoticiaRepository::class, NoticiaRepositoryEloquent::class);

        $this->app->bind(
            ItemRepository::class, ItemRepositoryEloquent::class);

        $this->app->bind(
            ClasseRepository::class, ClasseRepositoryEloquent::class);

        $this->app->bind(
            TipoDropRepository::class, TipoDropRepositoryEloquent::class);

        $this->app->bind(
            GrauItemRepository::class, GrauItemRepositoryEloquent::class);

        $this->app->bind(
            TipoItemRepository::class, TipoItemRepositoryEloquent::class);

        $this->app->bind(
            MochilaRepository::class, MochilaRepositoryEloquent::class);

        $this->app->bind(
            AvatarRepository::class, AvatarRepositoryEloquent::class);

        $this->app->bind(
            MaxAtributoRepository::class, MaxAtributoRepositoryEloquent::class);

        $this->app->bind(
            AvatarListRepository::class, AvatarListRepositoryEloquent::class);

        $this->app->bind(
            AndarRepository::class, AndarRepositoryEloquent::class);

        $this->app->bind(
            MapaRepository::class, MapaRepositoryEloquent::class);

        $this->app->bind(
            QuestRepository::class, QuestRepositoryEloquent::class);

        $this->app->bind(
            NpcRepository::class, NpcRepositoryEloquent::class);

    }
}
