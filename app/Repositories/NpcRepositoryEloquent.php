<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NpcRepository;
use App\Entities\Npc;
use App\Validators\NpcValidator;

/**
 * Class NpcRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NpcRepositoryEloquent extends BaseRepository implements NpcRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Npc::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return NpcValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
