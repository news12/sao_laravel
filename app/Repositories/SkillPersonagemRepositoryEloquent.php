<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SkillPersonagemRepository;
use App\Entities\PersonagemSkill;
use App\Validators\SkillPersonagemValidator;

/**
 * Class SkillPersonagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SkillPersonagemRepositoryEloquent extends BaseRepository implements SkillPersonagemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PersonagemSkill::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SkillPersonagemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
