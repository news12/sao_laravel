<?php

namespace App\Repositories;


use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Entities\Item;
use App\Validators\ItemValidator;

/**
 * Class ItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ItemRepositoryEloquent implements ItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Item::class;
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('items')
            ->select($columns)
            ->leftJoin('classes', 'items.id_classe', '=', 'classes.id')
            ->leftJoin('tipo_drops', 'items.id_tipo_drop', '=', 'tipo_drops.id')
            ->leftJoin('tipo_items', 'items.id_tipo_item', '=', 'tipo_items.id')
            ->leftJoin('grau_items', 'items.id_grau_item', '=', 'grau_items.id')
            ->orderBy('nome', 'desc')
            ->get();
        return $dados;
    }

    public function update($field = ['*'])
    {
        $update = DB::table('items')
            ->update($field);
        return $update;
    }

    public function update_where($field = ['*'], $where = null)
    {
        $update = DB::table('items')
            ->where('id', '=', $where['id_item'])
            ->update($field);

        return $update;

    }

    public function create($fields = [null])
    {
        $new_item = new Item;
        $new_item->nome = $fields['nome'];
        $new_item->descricao = $fields['descricao'];
        $new_item->level = $fields['level'];
        $new_item->id_classe = $fields['id_classe'];
        $new_item->for = $fields['for'];
        $new_item->int = $fields['int'];
        $new_item->agi = $fields['agi'];
        $new_item->def = $fields['def'];
        $new_item->esp = $fields['esp'];
        $new_item->evo = $fields['evo'];
        $new_item->mag = $fields['mag'];
        $new_item->energia = $fields['energia'];
        $new_item->vida = $fields['vida'];
        $new_item->cols = $fields['cols'];
        $new_item->cash = $fields['cash'];
        /* $new_item->vinculado = $fields['vinculado'];*/
        /*   $new_item->temporario = $fields['temporario'];*/
        $new_item->data_inicio = $fields['data_inicio'];
        $new_item->data_fim = $fields['data_fim'];
        $new_item->id_tipo_drop = $fields['id_tipo_drop'];
        $new_item->id_tipo_item = $fields['id_tipo_item'];
        $new_item->id_grau_item = $fields['id_grau_item'];
        $new_item->id_avatar = $fields['id_avatar'];
        $new_item->save();

        return $new_item;
    }

    public function selectID($field,$where = [null])
    {
        $dados = DB::table('items')
            ->select($field)
            ->where('id', $where['id_item'])
            ->get();

        return $dados;
    }

    public function delete($id)
    {
        $dados = DB::table('items')
            ->delete($id);

        return $dados;
    }


    public function validator()
    {

        return ItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
