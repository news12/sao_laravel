<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClasseRepository;
use App\Entities\Classe;
use App\Validators\ClasseValidator;

/**
 * Class ClasseRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClasseRepositoryEloquent implements ClasseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Classe::class;
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('classes')
            ->select($columns)
            ->orderBy('classe', 'asc')
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

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function validator()
    {

        return ClasseValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
