<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Max_atributoRepository;
use App\Entities\MaxAtributo;
use App\Validators\MaxAtributoValidator;

/**
 * Class MaxAtributoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MaxAtributoRepositoryEloquent implements MaxAtributoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MaxAtributo::class;
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('max_atributos')
            ->select($columns)
            ->get();

        return $dados;
    }

    public function validator()
    {

        return MaxAtributoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
