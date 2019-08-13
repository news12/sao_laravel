<?php

namespace App\Http\Controllers;

use App\Entities\PersonagemSkill;
use App\Entities\Skill;
use App\Repositories\PersonagemRepository;
use App\Repositories\SkillRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SkillCreateRequest;
use App\Http\Requests\SkillUpdateRequest;
use App\Validators\SkillValidator;

/**
 * Class SkillsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkillsController extends Controller
{
    /**
     * @var SkillRepository
     */
    protected $skill;

    private $personagem;
    protected $validator;
    private $id_skill_aprendida;
    private $contador_clan;
    private $tipo_msg = '';
    private $msg = '';
    private $level;
    private $boss;
    private $guild;
    private $evento;
    private $missao;
    private $coin;
    private $level_pass = false;
    private $coin_pass = false;
    private $status_personagem;

    /**
     * SkillsController constructor.
     *
     */
    public function __construct(SkillRepository $skill, PersonagemRepository $personagem)
    {
        $this->skill = $skill;
        $this->personagem = $personagem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $css_class = '';
        $this->contador_clan = 0;
        $id_personagem = $this->personagem->personagem_id();
        $skills = $this->skill->skills_do_personagem($id_personagem);
        $new_skill = $this->skill->skills();
        /*dd($new_skill);*/
        $skill_clan = $this->skill->skills_clan();
        return view('personagem.skill')
            ->with('skills', $skills)
            ->with('new_skill', $new_skill)
            ->with('css_class', $css_class)
            ->with('id_personagem', $id_personagem)
            ->with('id_skill_aprendida', $this->id_skill_aprendida)
            ->with('skill_clan', $skill_clan);

    }

    public function buySkill(Request $id)
    {

        $id_personagem = $this->personagem->personagem_id();
        $buy = $id->id_skill;
        $new_skill = $this->skill->buySkill($buy);
        $ja_aprendeu = $this->skill->verific_skill($id_personagem, $buy);
        //inicio Validacao
        $status_personagem = $this->personagem->personagem_status();
        foreach ($status_personagem as $status) {
            $this->level = $status->level;
            /*  $this->boss = $status->id_boss;
              $this->missao = $status->id_missao;
              $this->evento = $status->id_evento;
              $this->missao = $status->id_missao;*/
            $this->status_personagem = $status->status;
            $this->guild = $status->id_guild;
            $this->coin = $status->cols;

        }
        //fim Validacao
        if ($ja_aprendeu === 0) {
            if (empty($new_skill)) {
                $this->tipo_msg = 'error';
                $this->msg = 'Não foi possivel aprender a skill, verifique os requisitos necessários e tente novamente
            quando estiver atingido os requisitos minimos exigido.';

            }
            foreach ($new_skill as $new) {
                if ($this->level >= $new->reqlevel) {

                    if ($this->coin >= $new->cols) {

                        //debita o gold na conta do personagem
                        $this->personagem->dec('cols', $new->cols);
                        //adiciona a skill para o personagem
                        $skill_personagem = new PersonagemSkill;

                        $skill_personagem->id_skill = $new->id;
                        $skill_personagem->id_personagem = $id_personagem;
                        $skill_personagem->save();
                        $this->tipo_msg = 'success';
                        $this->msg = 'Skill aprendida com sucesso';

                    } else {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Cols insuficiente para aprender essa skill';

                    }

                } else {
                    $this->tipo_msg = 'error';
                    $this->msg .= 'Level insuficiente para aprender essa skill';


                }

            }

        } else {
            $this->tipo_msg = 'error';
            $this->msg = 'Você já aprendeu essa habilidade..';
        }


        $id->session()->flash($this->tipo_msg, $this->msg);

        return response()->json([$this->tipo_msg, $this->msg]);
    }


    public function destroy($id)
    {
        //remover skill
    }
}
