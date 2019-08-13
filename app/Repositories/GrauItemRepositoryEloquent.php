<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GrauItemRepository;
use App\Entities\GrauItem;
use App\Validators\GrauItemValidator;

/**
 * Class GrauItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GrauItemRepositoryEloquent implements GrauItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GrauItem::class;
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

    public function all($columns = ['*'])
    {
        $dados = DB::table('grau_items')
            ->select($columns)
            ->orderBy('nome', 'asc')
            ->get();
        return $dados;
    }

    public function selectID($id)
    {
        $dados = DB::table('grau_items')
            ->select('*')
            ->where('id', '=', $id)
            ->get();
        return $dados;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return GrauItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
