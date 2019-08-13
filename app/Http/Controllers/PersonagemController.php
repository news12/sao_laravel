<?php

namespace App\Http\Controllers;

use App\Entities\Personagem;
use App\Http\Requests\CreatePersonagem;
use App\Repositories\AvatarListRepository;
use App\Repositories\AvatarRepository;
use App\Repositories\MaxAtributoRepository;
use App\Repositories\PersonagemRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class PersonagemController extends Controller
{
    protected $repository;
    protected $maxAtributosRepository;
    protected $avatarRepository;
    protected $avatarListRepository;

    private $totalPagina = 15;
    private $pontos_do_player = 0;
    private $pontos_distribuidos = 0;
    private $max_avatar;
    private $max_avatar_vip;
    private $tipo_vip;
    private $max_personagem;
    private $tipo_msg;
    private $msg;
    private $avatar_selecionado;
    private $avatar_nome;


    public function __construct(
        PersonagemRepository $repository,
        MaxAtributoRepository $maxAtributoRepository,
        AvatarRepository $avatarRepository,
        AvatarListRepository $avatarListRepository
    )
    {

        $this->repository = $repository;
        $this->maxAtributosRepository = $maxAtributoRepository;
        $this->avatarRepository = $avatarRepository;
        $this->avatarListRepository = $avatarListRepository;

    }

    public
    function index()
    {
        $avatar_select = 'passivo';
        $sessao_avatar = $this->repository->personagem_avatar();

        return view('personagem.personagem', compact('sessao_avatar', 'avatar_select'));
    }

    public
    function status()
    {
        //pagina de status do personagem

        return view('personagem.status');
    }

    public
    function statusUpdate(Request $status)
    {

        $this->pontos_do_player = $this->repository->personagem_pontos();

        $for = $status->for_input;
        $int = $status->int_input;
        $agi = $status->agi_input;
        $def = $status->def_input;
        $res = $status->res_input;
        $vit = $status->vit_input;
        $esp = $status->esp_input;
        $mag = $status->mag_input;
        $evo = $status->evo_input;

        $this->pontos_distribuidos += $for;
        $this->pontos_distribuidos += $int;
        $this->pontos_distribuidos += $agi;
        $this->pontos_distribuidos += $def;
        $this->pontos_distribuidos += $res;
        $this->pontos_distribuidos += $vit;
        $this->pontos_distribuidos += $esp;
        $this->pontos_distribuidos += $mag;
        $this->pontos_distribuidos += $evo;

        //Proteção contra injeção direto no js
        if ($this->pontos_do_player >= $this->pontos_distribuidos) {
            $this->pontos_do_player -= $this->pontos_distribuidos;
            $this->repository->update(['ponto' => $this->pontos_do_player]);

            if ($for > 0) {
                $this->repository->inc('forca', $for);
            }

            if ($int > 0) {
                $this->repository->inc('inteligencia', $int);
            }

            if ($agi > 0) {
                $this->repository->inc('agilidade', $agi);
            }

            if ($def > 0) {
                $this->repository->inc('defesa', $def);
            }

            if ($res > 0) {
                $this->repository->inc('resistencia', $res);
            }

            if ($vit > 0) {
                $this->repository->inc('vitalidade', $vit);
            }

            if ($esp > 0) {
                $this->repository->inc('espada', $esp);
            }

            if ($mag > 0) {
                $this->repository->inc('magia', $mag);
            }

            if ($evo > 0) {
                $this->repository->inc('evoc', $evo);
            }


            $status->session()->flash('success', 'Pontos adcionados com sucesso!!!');
            return redirect('statusP');

        }

        $status->session()->flash('error', 'Houve uma tentativa de inserir dados de forma irregular, 
        caso esta ação se repita você poderá ter sua conta banida permanentemento!!!');
        return redirect('statusP');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create(CreatePersonagem $request)
    {
        $this->tipo_vip = Auth::user()->tipo_vip;
        $new_perso = $request->nome;
        $new_avatar = $request->avatar_select;
        if (empty($new_avatar)) {
            $request->session()->flash('error', 'Favor selecionar um avatar');
            return redirect('showP');
        }
        $max_atributos = $this->maxAtributosRepository->all();
        foreach ($max_atributos as $config) {
            $this->max_avatar = $config->max_avatar;
            $this->max_avatar_vip = $config->max_avatar_vip;
        }

        $total_personagens = $this->repository->count_id(
            ['id'],
            ['conta' => Auth::id()]
        );

        if ($this->tipo_vip > 0) {
            $this->max_personagem = $this->max_avatar_vip + $this->max_avatar;
        } else {
            $this->max_personagem = $this->max_avatar;
        }
        if ($total_personagens < $this->max_personagem) {
            //Se tiver personagem ativo, desativa
            $this->repository->update(['ativo' => 0]);
            //Cria o novo personagem e ativa ele
            try {
                $this->repository->create(
                    [
                        'nome' => $request->nome,
                        'id_avatar' => $request->avatar_select,
                        'conta' => Auth::id()
                    ]);
                $this->tipo_msg = 'success';
                $this->msg = 'Personagem criado com sucesso!!!';

            } catch (exception $error) {

                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro: ' . $error;

            }
        } else {

            $this->tipo_msg = 'error';
            $this->msg = 'Limite máximo de personagens atingido, você não pode criar novos personagens';

        }


        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect()->route('personagem');

    }

    public
    function avatar()
    {
        $tipo_conta = Auth::user()->tipo_vip;
        $status = $this->repository->personagem_status();
        foreach ($status as $avatar) {
            $this->avatar_selecionado = $avatar->id_avatar;
        }
        $avatar_list = $this->avatarListRepository->select_avatar(
            [
                '*'
            ],
            [
                'id_avatar' => $this->avatar_selecionado
            ]
        );


        $avatar = $this->avatarRepository->selectID('*',
            ['id' => $this->avatar_selecionado]
        );

        foreach ($avatar as $status_avatar) {

            $this->avatar_nome = $status_avatar->avatar;
        }

        return view('personagem.avatar')
            ->with('avatar', $avatar)
            ->with('avatar_list', $avatar_list)
            ->with('vip', $tipo_conta)
            ->with('avatar_nome', $this->avatar_nome);

    }

    public
    function updateAvatar(Request $request)
    {

        $status_personagem = $this->repository->personagem_status();
        $id_personagem = $this->repository->personagem_id();

        foreach ($status_personagem as $status) {

            $this->avatar_selecionado = $status->id_avatar;

        }

        if ($this->avatar_selecionado !== $request->id_avatar) {

            Try {
                $this->repository->update_where(
                    [
                        'img_avatar' => $request->id_avatar
                    ],
                    [
                        'id_personagem' => $id_personagem
                    ]);

                $this->tipo_msg = 'success';
                $this->msg = 'Avatar alterado com sucesso';

            } catch (exception $error) {

                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro: ' . $error;

            }
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('indexAvatar');

    }

    public
    function store(Request $request)
    {
        $id_perso = $request->id_perso;
        $msgTroca = /** @lang text */
            'Personagem <b>' . $request->nome_perso . '</b> selecionado com sucesso!!!';

        $this->repository->update(['ativo' => 0]);
        $this->repository->update_where(['ativo' => 1], ['id_personagem' => $id_perso]);
        $request->session()->flash('success', $msgTroca);
        return redirect('personagem');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\repository $personagem
     * @return \Illuminate\Http\Response
     */
    public
    function show()
    {
        $create_avatar = DB::table('avatars')
            ->where('tipo', '=', 0)
            ->orderBy('avatar')
            ->paginate($this->totalPagina);
        return view('personagem.criar', compact('create_avatar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\repository $personagem
     * @return \Illuminate\Http\Response
     */
    public
    function edit(personagem $personagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\personagem $personagem
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, personagem $personagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\personagem $personagem
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Request $personagem)
    {
        $tipo_msg = '';
        $msg = '';
        $id_personaagem = $personagem->id_personagem;
        //procetação contra injeção js
        $verifica_id = DB::table('personagems')
            ->select('id')
            ->where('id', '=', $id_personaagem)
            ->where('conta', '=', Auth::id())
            ->count();

        if ($verifica_id === 0) {
            $tipo_msg = 'error';
            $msg = 'Personagem inexistente ou não pertence a você...';
        } else {
            $delete = DB::table('personagems')
                ->delete($id_personaagem);

            if ($delete) {
                $tipo_msg = 'success';
                $msg = 'Personagem Deletado com sucesso!!!';
            } else {
                $tipo_msg = 'error';
                $msg = 'Falha ao tentar deletar o personagem, tente novamente mais tarde.';

            }
        }


        $personagem->session()->flash($tipo_msg, $msg);
        return redirect('personagem');
    }
}
