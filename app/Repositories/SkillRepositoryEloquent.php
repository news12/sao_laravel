<?php

namespace App\Repositories;


use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Skill;
use App\Validators\SkillValidator;

/**
 * Class SkillRepositoryEloquent.
 *

 */
class SkillRepositoryEloquent implements SkillRepository
{
    private $skill_personagem;
    private $skills;
    private $skills_clan;
    private $personagem;
    private $id_personagem;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function __construct(PersonagemRepository $personagem)
    {
        $this->personagem = $personagem;

    }

    public function model()
    {
        return Skill::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return SkillValidator::class;
    }

    public function skills_do_personagem($id_personagem)
    {

        $this->skill_personagem = DB::table('skills')
            ->select('personagem_skill.id_personagem', 'skills.*', 'personagem_skill.id_skill',
                'skill_status.dano_fisico', 'skill_status.dano_magico', 'skill_status.dano_evoc', 'skill_status.critico',
                'skill_status.esquiva', 'skill_status.bloqueio', 'skill_status.defesa', 'skill_status.resistencia',
                'skill_status.hp', 'skill_status.cura', 'skill_status.reqlevel', 'skill_status.reqmissao', 'skill_status.reqboss',
                'reqevento', 'skill_status.reqguild', 'skill_status.expira', 'skill_status.inicio', 'skill_status.fim')
            ->leftJoin('personagem_skill', 'skills.id', '=', 'personagem_skill.id_skill')
            ->leftJoin('personagems', 'personagem_skill.id_personagem', '=', 'personagems.id')
            ->join('skill_status', 'skills.id', '=', 'skill_status.id_skill')
            ->where('personagem_skill.id_personagem', '=', $id_personagem)
            ->orderBy('level')
            ->orderBy('nome')
            ->get();


        return $this->skill_personagem->all();
    }

    public function skills()
    {
        $this->id_personagem = $this->personagem->personagem_id();
        $id_classe = $this->personagem->personagem_id_classe($this->id_personagem);
        $this->skills = DB::table('skills')
            ->select('skills.*', 'classes.classe',
                'skill_status.dano_fisico', 'skill_status.dano_magico', 'skill_status.dano_evoc', 'skill_status.critico',
                'skill_status.esquiva', 'skill_status.bloqueio', 'skill_status.defesa', 'skill_status.resistencia',
                'skill_status.hp', 'skill_status.cura', 'skill_status.reqlevel', 'skill_status.reqmissao', 'skill_status.reqboss',
                'reqevento', 'skill_status.reqguild', 'skill_status.expira', 'skill_status.inicio', 'skill_status.fim')
            ->leftJoin('classes', 'skills.id_classe', '=', 'classes.id')
            /*     ->leftJoin('personagem_skill', 'skills.id', '=', 'personagem_skill.id_skill')*/
            ->whereNotExists(function ($query) {
                $query->select('id_skill')
                    ->from('personagem_skill')
                    ->whereRaw('skills.id = personagem_skill.id_skill');
            })
            ->join('skill_status', 'skills.id', '=', 'skill_status.id_skill')
            /*   ->where('personagem_skill.id_personagem', '=', $id_personagem)*/
            ->whereIn('id_classe', [0, 99, $id_classe])
            ->orderBy('level')
            ->orderBy('nome')
            ->get();
          /*dd( $this->id_personagem );*/
        return $this->skills->all();
    }

    public function skills_clan()
    {
        $id_personagem = $this->personagem->personagem_id();
        $id_classe = $this->personagem->personagem_id_classe($id_personagem);
        $this->skills = DB::table('skills')
            ->select('skills.*', 'classes.classe',
                'skill_status.dano_fisico', 'skill_status.dano_magico', 'skill_status.dano_evoc', 'skill_status.critico',
                'skill_status.esquiva', 'skill_status.bloqueio', 'skill_status.defesa', 'skill_status.resistencia',
                'skill_status.hp', 'skill_status.cura', 'skill_status.reqlevel', 'skill_status.reqmissao', 'skill_status.reqboss',
                'reqevento', 'skill_status.reqguild', 'skill_status.expira', 'skill_status.inicio', 'skill_status.fim')
            ->leftJoin('classes', 'skills.id_classe', '=', 'classes.id')
            ->whereNotExists(function ($query) {
                $query->select('id_skill')
                    ->from('personagem_skill')
                    ->whereRaw('skills.id = personagem_skill.id_skill');
            })
            ->join('skill_status', 'skills.id', '=', 'skill_status.id_skill')
            /*   ->where('personagem_skill.id_personagem', '=', $id_personagem)*/
            ->whereIn('id_classe', [0, 99, $id_classe])
            ->where('skill_status.reqguild', '=', 1)
            ->orderBy('level')
            ->orderBy('nome')
            ->get();

        return $this->skills->all();
    }

    public function buySkill($id)
    {
        $id_personagem = $this->personagem->personagem_id();
        $id_classe = $this->personagem->personagem_id_classe($id_personagem);
        $skill = DB::table('skills')
            ->select('skills.*', 'classes.classe', 'personagem_skill.id_personagem',
                'skill_status.dano_fisico', 'skill_status.dano_magico', 'skill_status.dano_evoc', 'skill_status.critico',
                'skill_status.esquiva', 'skill_status.bloqueio', 'skill_status.defesa', 'skill_status.resistencia',
                'skill_status.hp', 'skill_status.cura', 'skill_status.reqlevel', 'skill_status.reqmissao', 'skill_status.reqboss',
                'reqevento', 'skill_status.reqguild', 'skill_status.expira', 'skill_status.inicio', 'skill_status.fim')
            ->leftJoin('classes', 'skills.id_classe', '=', 'classes.id')
            ->leftJoin('personagem_skill', 'skills.id', '=', 'personagem_skill.id_skill')
            ->join('skill_status', 'skills.id', '=', 'skill_status.id_skill')
            ->whereIn('id_classe', [0, 99, $id_classe])
            ->where('skills.id', '=', $id)
            ->get();
        /* dd($skill);*/
        return $skill->all();
    }

    public function verific_skill($personagem, $id)
    {
        $existe = DB::table('personagem_skill')
            ->select('id_skill')
            ->where('id_skill', '=', $id)
            ->where('id_personagem', '=', $personagem)
            ->count();

        return $existe;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
