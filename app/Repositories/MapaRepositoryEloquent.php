<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MapaRepository;
use App\Entities\Mapa;
use App\Validators\MapaValidator;

/**
 * Class MapaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MapaRepositoryEloquent implements MapaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Mapa::class;
    }

    public function create($fields = [null])
    {
        // TODO: Implement create() method.
    }

    public function update_where($field = ['*'], $where = null)
    {
        // TODO: Implement update_where() method.
    }

    public function all($columns = ['*'])
    {
        // TODO: Implement all() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function selectID($field, $where = [null])
    {
        $dados = DB::table('mapas')
            ->select($field)
            ->where($where)
            ->get();

        return $dados;
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }


    public function validator()
    {

        return MapaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
