<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\QuestRepository;
use App\Entities\Quest;
use App\Validators\QuestValidator;

/**
 * Class QuestRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class QuestRepositoryEloquent implements QuestRepository
{
    private $table = 'quests';

    public function model()
    {
        return Quest::class;
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    public function selectID($field, $where = [null])
    {
        $dados = DB::table($this->table)
            ->select($field)
            ->where($where)
            ->get();

        return $dados;
    }

    public function delete($id)
    {
        $dados = DB::table($this->table)
            ->delete($id);

        return $dados;
    }

    public function all($columns = ['*'],$where=[null])
    {
        if (isset($where['id_andar'])) {
            $dados = DB::table($this->table)
                ->select($columns)
                ->where('id_andar',$where['id_andar'])
                ->get();
        }
        else {
            $dados = DB::table($this->table)
                ->select($columns)
                ->get();
        }

        return $dados;
    }

    public function update_where($field = ['*'], $where = null)
    {
        $dados = DB::table($this->table)
            ->where('id', '=', $where['id_quest'])
            ->update($field);

        return $dados;
    }

    public function create($fields = [null])
    {
        $new_quest = new Quest;
        $new_quest->titulo = $fields['titulo'];
        $new_quest->descricao = $fields['descricao'];
        $new_quest->level = $fields['level'];
        $new_quest->guild = $fields['guild'];
        $new_quest->boss = $fields['boss'];
        $new_quest->status = $fields['status'];
        $new_quest->cols = $fields['cols'];
        $new_quest->exp = $fields['exp'];
        $new_quest->itens = $fields['itens'];
        $new_quest->save();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
