<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ClasseRepository::class, \App\Repositories\ClasseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MaxAtributoRepository::class, \App\Repositories\MaxAtributoRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RankRepository::class, \App\Repositories\RankRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AndarRepository::class, \App\Repositories\AndarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EquipeRepository::class, \App\Repositories\EquipeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ItemRepository::class, \App\Repositories\ItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NpcRepository::class, \App\Repositories\NpcRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MochilaRepository::class, \App\Repositories\MochilaRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\SkillPersonagemRepository::class, \App\Repositories\SkillPersonagemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PersonagemSkillRepository::class, \App\Repositories\PersonagemSkillRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RolesRepository::class, \App\Repositories\RolesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\NoticiaRepository::class, \App\Repositories\NoticiaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoDropRepository::class, \App\Repositories\TipoDropRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TipoItemRepository::class, \App\Repositories\TipoItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GrauItemRepository::class, \App\Repositories\GrauItemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AvatarRepository::class, \App\Repositories\AvatarRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AvatarListRepository::class, \App\Repositories\AvatarListRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MapaRepository::class, \App\Repositories\MapaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\QuestRepository::class, \App\Repositories\QuestRepositoryEloquent::class);
        //:end-bindings:
    }
}
