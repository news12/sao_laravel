<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AndarRepository;
use App\Entities\Andar;
use App\Validators\AndarValidator;

/**
 * Class AndarRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AndarRepositoryEloquent implements AndarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Andar::class;
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    public function selectID($field, $where = [null])
    {
        $dados = DB::table('andars')
            ->select($field)
            ->where($where)
            ->get();

        return $dados;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('andars')
            ->select($columns)
            ->orderBy('id', 'asc')
            ->get();
        return $dados;
    }

    public function update_where($field = ['*'], $where = null)
    {
        // TODO: Implement update_where() method.
    }

    public function create($fields = [null])
    {
        // TODO: Implement create() method.
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function validator()
    {

        return AndarValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
