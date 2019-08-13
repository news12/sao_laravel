<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoDropRepository;
use App\Entities\TipoDrop;
use App\Validators\TipoDropValidator;

/**
 * Class TipoDropRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoDropRepositoryEloquent implements TipoDropRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoDrop::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return TipoDropValidator::class;
    }

    public function update_where($field = ['*'], $where = null)
    {
        // TODO: Implement update_where() method.
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function create($fields = [null])
    {
        // TODO: Implement create() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('tipo_drops')
            ->select($columns)
            ->orderBy('nome', 'asc')
            ->get();
        return $dados;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
