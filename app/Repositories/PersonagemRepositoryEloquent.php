<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PersonagemRepository;
use App\Entities\Personagem;
use App\Validators\PersonagemValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PersonagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PersonagemRepositoryEloquent implements PersonagemRepository
{
    private $personagem;
    private $pontos_player;
    private $id_classe;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Personagem::class;
    }

    public function personagem_status()
    {
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
        return $status_personagem;
    }

    public function personagem_id()
    {
        $id_personagem = DB::table('personagems')
            ->select('personagems.*')
            ->where('conta', '=', Auth::id())
            ->where('ativo', '=', 1)
            ->limit(1)
            ->get();
        foreach ($id_personagem as $personagem) {
            $this->personagem = $personagem->id;

        }

        return $this->personagem;
    }

    public function personagem_pontos()
    {
        $pontos = DB::table('personagems')
            ->select('ponto')
            ->where('conta', '=', Auth::id())
            ->where('ativo', '=', 1)
            ->get();
        foreach ($pontos as $ponto) {
            $this->pontos_player = $ponto->ponto;
        }
        return $this->pontos_player;
    }

    public function personagem_avatar()
    {
        $dados = DB::table('personagems')
            ->select('personagems.*', 'classes.classe', 'levels.level as max_level',
                'levels.cols as rec_cols', 'levels.exp as max_exp',
                'levels.hp as rec_hp', 'levels.energia as rec_energia', 'avatars.avatar as avatar')
            ->join('classes', 'personagems.id_classe', 'classes.id')
            ->join('levels', 'personagems.level', '=', 'levels.id')
            ->join('avatars', 'personagems.id_avatar', '=', 'avatars.id')
            ->where('conta', '=', Auth::id())
            ->orderBy('level', 'desc')
            /* ->limit(8)*/
            ->get();
        return $dados;
    }

    public function count_id($field = ['*'], $where = [null])
    {
        $dados = DB::table('personagems')
            ->select($field)
            ->where($where)
            ->count();

        return $dados;
    }

    public function create($fields = [null])
    {
        $personagem = new Personagem;
        $personagem->nome = $fields['nome'];
        $personagem->id_avatar = $fields['id_avatar'];
        $personagem->conta = Auth::id();
        $personagem->ativo = 1;
        $personagem->save();

        return $personagem;
    }

    public function update($field = ['*'])
    {


        $update = DB::table('personagems')
            ->where('conta', '=', Auth::id())
            ->where('ativo', '=', 1)
            ->update($field);
        return $update;
    }

    public function update_where($field = ['*'], $where = null)
    {

        if ($where['id_personagem'] !== null) {
            $update = DB::table('personagems')
                ->where('conta', '=', Auth::id())
                ->where('id', '=', $where['id_personagem'])
                ->update($field);
            return $update;
        }
        return false;
    }

    public function inc($field, $valor)
    {
        $incremento = DB::table('personagems')
            ->where('conta', '=', Auth::id())
            ->where('ativo', '=', 1)
            ->increment($field, $valor);

        return $incremento;
    }

    public function dec($field, $valor)
    {
        $decremento = DB::table('personagems')
            ->where('conta', '=', Auth::id())
            ->where('ativo', '=', 1)
            ->decrement($field, $valor);

        return $decremento;
    }

    public function personagem_id_classe($id_personagem)
    {
        $personagem = DB::table('personagems')
            ->select('personagems.*')
            ->where('id', '=', $id_personagem)
            ->limit(1)
            ->get();
        foreach ($personagem as $classe) {
            $this->id_classe = $classe->id_classe;

        }
        /*dd($this->id_classe);*/
        return $this->id_classe;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
