<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SkillRepository.
 *
 * @package namespace App\Repositories;
 */
interface SkillRepository
{
    public function skills_do_personagem($id_personagem);

    public function skills();

    public function skills_clan();

    public function verific_skill($personagem, $id);

    public function buySkill($id);


}
