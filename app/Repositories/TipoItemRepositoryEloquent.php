<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TipoItemRepository;
use App\Entities\TipoItem;
use App\Validators\TipoItemValidator;

/**
 * Class TipoItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TipoItemRepositoryEloquent implements TipoItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoItem::class;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('tipo_items')
            ->select($columns)
            ->orderBy('nome', 'asc')
            ->get();
        return $dados;
    }

    public function create($fields = [null])
    {
        // TODO: Implement create() method.
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function update_where($field = ['*'], $where = null)
    {
        // TODO: Implement update_where() method.
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return TipoItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
