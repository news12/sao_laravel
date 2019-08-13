<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Mochila;
use App\Validators\MochilaValidator;

/**
 * Class MochilaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MochilaRepositoryEloquent implements MochilaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Mochila::class;
    }


    public function selectID($where = [null])
    {

        if (isset($where['delete_panel_admin'])) {

            $dados = DB::table('mochilas')
                ->select('id')
                ->where('id_item', $where['id_item'])
                ->count();

        } else {
            $dados = DB::table('mochilas')
                ->select('id', 'id_item')
                ->where('id_personagem', '=', $where['personagem'])
                ->where('id', $where['id_mochila'])
                ->where('status', '=', 0)
                ->get();
        }

        return $dados;
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function create($fields = [null])
    {
        // TODO: Implement create() method.
    }

    public function all($columns = ['*'], $where = [null])
    {
        if (isset($where['id_bag'])) {
            $dados = DB::table('mochilas')
                ->select($columns)
                ->join('items', 'mochilas.id_item', '=', 'items.id')
                ->join('grau_items', 'items.id_grau_item', '=', 'grau_items.cod_grau')
                ->join('tipo_items', 'items.id_tipo_item', '=', 'tipo_items.slot')
                ->leftJoin('classes', 'items.id_classe', '=', 'classes.id')
                ->where('id_personagem', '=', $where['personagem'])
                ->where('mochilas.id', '=', $where['id_bag'])
                ->get();
        } else {

            $dados = DB::table('mochilas')
                ->select($columns)
                ->join('items', 'mochilas.id_item', '=', 'items.id')
                ->join('grau_items', 'items.id_grau_item', '=', 'grau_items.cod_grau')
                ->join('tipo_items', 'items.id_tipo_item', '=', 'tipo_items.slot')
                ->leftJoin('classes', 'items.id_classe', '=', 'classes.id')
                ->where('id_personagem', '=', $where['personagem'])
                ->get();
        }
        return $dados;
    }

    public function selectSlotBag($columns = ['*'], $where = [null])
    {
        $tipo = $where['tipo'];
        $dados = DB::table('mochilas')
            ->select('status')
            ->where('status', '=', $where['status'])
            ->where('id_personagem', '=', $where['personagem'])
            ->$tipo();

        return $dados;
    }

    public function selectSlotPerso($columns = ['*'], $where = [null])
    {
        $tipo = $where['tipo'];
        $dados = DB::table('mochilas')
            ->select('status')
            ->where('status', '!=', $where['status'])
            ->where('id_personagem', '=', $where['personagem'])
            ->$tipo();

        return $dados;
    }

    public function delete($id)
    {
        $datos = DB::table('mochilas')
            ->delete($id);

        return $datos;
    }

    public function update_where($field = ['*'], $where = null, $requisitor = null)
    {
        if ($requisitor === 'remove') {
            $update = DB::table('mochilas')
                ->where('status', '=', $where['status'])
                ->where('id_personagem', '=', $where['personagem'])
                ->update($field);
        } elseif ($requisitor === 'equipe') {
            $update = DB::table('mochilas')
                ->where('id', '=', $where['id_mochila'])
                ->where('id_personagem', '=', $where['personagem'])
                ->update($field);
        }

        return $update;
    }

    public function validator()
    {

        return MochilaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
