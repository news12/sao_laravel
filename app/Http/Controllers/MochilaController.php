<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepository;
use App\Repositories\PersonagemRepository;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MochilaCreateRequest;
use App\Http\Requests\MochilaUpdateRequest;
use App\Repositories\MochilaRepository;
use App\Validators\MochilaValidator;

/**
 * Class MochilaController.
 *
 * @package namespace App\Http\Controllers;
 */
class MochilaController extends Controller
{
    /**
     * @var MochilaRepository
     */
    protected $repository;
    protected $validator;
    protected $personagemRepository;
    protected $itemRepository;

    private $total_slot;
    private $total_pag = 25;
    private $arma_equipado = false;
    private $escudo_equipado = false;
    private $anel_D_equipado = false;
    private $anel_E_equipado = false;
    private $colar_equipado = false;
    private $brinco_D_equipado = false;
    private $brinco_E_equipado = false;
    private $elmo_equipado = false;
    private $armadura_equipado = false;
    private $calca_equipado = false;
    private $luva_equipado = false;
    private $bota_equipado = false;
    private $pet_equipado = false;
    private $manto_equipado = false;
    private $equipar_item;
    private $remover_item;
    private $id_personagem_select;
    private $tipo_msg = '';
    private $msg = '';
    private $item_equipavel = false;
    private $level_personagem;
    private $classe_personagem;
    private $itens_bag;
    private $max_bag;

    /**
     * MochilaController constructor.
     *
     * @param MochilaRepository $repository
     * @param MochilaValidator $validator
     */
    public function __construct(
        MochilaRepository $repository,
        PersonagemRepository $personagemRepository,
        ItemRepository $itemRepository
    )
    {
        $this->repository = $repository;
        $this->personagemRepository = $personagemRepository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_logado = $this->personagemRepository->personagem_id();

        //pega todos os status do personagem
        $status_personagem = $this->personagemRepository->personagem_status();

        //seleciona o item do personagem na bag
        $itens_bag = $this->repository->all([
            'mochilas.status as status',
            'mochilas.id as id_mochila',
            'mochilas.id_personagem as id_personagem',
            'mochilas.id_item as id_item',
            'mochilas.id_grau as id_grau',
            'grau_items.nome as grau',
            'items.*',
            'classes.classe',
            'tipo_items.nome as tipo',
            'items.id_tipo_item as id_tipo_item',
            'items.id_classe as id_classe_item',
            'items.poder_fisico',
            'items.poder_magico',
            'items.poder_evocacao',
            'items.esquiva',
            'items.critico',
            'items.bloqueio',
            'items.poder'
        ], ['personagem' => $user_logado]);


        //verifica se o slot esta equipado no personagem
        $slot_em_uso = $this->repository->selectSlotPerso(['status'], [
            'status' => 0,
            'personagem' => $user_logado,
            'tipo' => 'get'
        ]);

        //conta os slots que não estão equipados no personagem

        $total_itens = $this->repository->selectSlotBag(['status'], [
            'status' => 0,
            'personagem' => $user_logado,
            'tipo' => 'count'
        ]);


        foreach ($status_personagem as $max_bags) {
            //passa para uma variavel a soma de max_slot do personagem free e slot adiciona vip
            $this->total_slot = $max_bags->max_mochila + $max_bags->max_vip_mochila;
        }
        //varredura para montar os slots do personagem
        foreach ($slot_em_uso as $slot_oculpado) {
            //para cada slot equipavel ativa uma variavel para montar as imagens na view
            if ($slot_oculpado->status == 1) {//slot arma
                $this->arma_equipado = true;
            }
            if ($slot_oculpado->status == 2) {//slot escudo/arma2
                $this->escudo_equipado = true;
            }
            if ($slot_oculpado->status == 3) {//slot elmo
                $this->elmo_equipado = true;
            }
            if ($slot_oculpado->status == 4) {//slot armadura
                $this->armadura_equipado = true;
            }
            if ($slot_oculpado->status == 5) {//slot calca
                $this->calca_equipado = true;
            }
            if ($slot_oculpado->status == 6) {//slot luva
                $this->luva_equipado = true;
            }
            if ($slot_oculpado->status == 7) {//slot bota
                $this->bota_equipado = true;
            }
            if ($slot_oculpado->status == 8) {//slot manto
                $this->manto_equipado = true;
            }
            if ($slot_oculpado->status == 9) {//slot colar
                $this->colar_equipado = true;
            }
            if ($slot_oculpado->status == 10) {//brinco D
                $this->brinco_D_equipado = true;
            }
            if ($slot_oculpado->status == 11) {//brinco E
                $this->brinco_E_equipado = true;
            }
            if ($slot_oculpado->status == 12) {//anel D
                $this->anel_D_equipado = true;
            }
            if ($slot_oculpado->status == 13) {//Anel E
                $this->anel_E_equipado = true;
            }
            if ($slot_oculpado->status == 14) {//Pet
                $this->pet_equipado = true;
            }

        }


        return view('mochila.mochila')
            ->with('total_slot', $this->total_slot)
            ->with('itens_bag', $itens_bag)
            ->with('total_itens', $total_itens)
            ->with('arma_equipado', $this->arma_equipado)
            ->with('escudo_equipado', $this->escudo_equipado)
            ->with('elmo_equipado', $this->elmo_equipado)
            ->with('armadura_equipado', $this->armadura_equipado)
            ->with('calca_equipado', $this->calca_equipado)
            ->with('luva_equipado', $this->luva_equipado)
            ->with('bota_equipado', $this->bota_equipado)
            ->with('manto_equipado', $this->manto_equipado)
            ->with('brinco_D_equipado', $this->brinco_D_equipado)
            ->with('brinco_E_equipado', $this->brinco_E_equipado)
            ->with('pet_equipado', $this->pet_equipado)
            ->with('anel_E_equipado', $this->anel_E_equipado)
            ->with('colar_equipado', $this->colar_equipado)
            ->with('anel_D_equipado', $this->anel_D_equipado);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MochilaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MochilaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mochila = $this->repository->create($request->all());

            $response = [
                'message' => 'Mochila created.',
                'data' => $mochila->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mochila = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mochila,
            ]);
        }

        return view('mochilas.show', compact('mochila'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mochila = $this->repository->find($id);

        return view('mochilas.edit', compact('mochila'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MochilaUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function equipeItem(Request $itens_bag)
    {
        $this->equipar_item = $itens_bag->id_bag;

        $dados_personagem = $this->personagemRepository->personagem_status();

        foreach ($dados_personagem as $personagem) {
            $this->id_personagem_select = $personagem->id;
            $this->classe_personagem = $personagem->id_classe;
            $this->level_personagem = $personagem->level;

        }
        //faz um select com o id vindo da view para verificar se foi passado um id correto;
        $item_personagem = $this->repository->all([
            'mochilas.*',
            'items.id_tipo_item',
            'items.id_classe',
            'items.level'
        ],
            [
                'personagem' => $this->id_personagem_select,
                'id_bag' => $this->equipar_item]);


        //verifica se existe um id na collection
        if (!isset($item_personagem)) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro, nenhum item foi encontrado, tente novamente mais tarde';
        }
        //se o collection estiver vazio não sera executado o foreach

        foreach ($item_personagem as $mochila) {
            //verifica se o item é do tipo equipavel slot 1 a 14
            if ($mochila->id_tipo_item > 0 && $mochila->id_tipo_item < 15) {
                $this->item_equipavel = true;
            }
            if ($this->item_equipavel == true) {
                //verifica se o item é do personagem que solicitou, se o personagem tem level e se tem classe permitida
                if ($mochila->id == $this->equipar_item && $mochila->level <= $this->level_personagem && (
                        $mochila->id_classe == $this->classe_personagem || $mochila->id_classe == 99)) {
                    //se ja existir um item equipado no slot, ira remover e jogar para a mochila
                    $this->repository->update_where(
                        [
                            'status' => 0
                        ],
                        [
                            'status' => $mochila->id_tipo_item,
                            'personagem' => $this->id_personagem_select
                        ], 'remove');

                    //equipa o item atual no slot correto
                    $this->repository->update_where(
                        [
                            'status' => $mochila->id_tipo_item
                        ],
                        [
                            'id_mochila' => $this->equipar_item,
                            'personagem' => $this->id_personagem_select
                        ], 'equipe');


                    $this->tipo_msg = 'success';
                    $this->msg = 'Item equipado com sucesso!!!';
                } else {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Você não pode equipar o item, verifique os requisitos do item e tente novamente
                    quando tiver atingido os requisitos necessários';

                }
            } else {
                $this->tipo_msg = 'error';
                $this->msg = 'Esse item não é do tipo equipável..';
            }
        }

        $itens_bag->session()->flash($this->tipo_msg, $this->msg);
        /*  return redirect('bag');*/
        return response()->json([$this->tipo_msg, $this->msg]);
    }

    public function unequipeItem(Request $item_slot)
    {
        $this->remover_item = $item_slot->id_slot;

        $dados_personagem = $this->personagemRepository->personagem_status();

        foreach ($dados_personagem as $personagem) {
            $this->id_personagem_select = $personagem->id;
            $this->max_bag = $personagem->max_mochila + $personagem->max_vip_mochila;

        }
        $this->itens_bag = $this->repository->selectSlotBag(['status'], [
            'status' => 0,
            'personagem' => $this->id_personagem_select,
            'tipo' => 'count'
        ]);


        $slot_selecionado = $this->repository->selectSlotBag(['status'], [
            'status' => $this->remover_item,
            'personagem' => $this->id_personagem_select,
            'tipo' => 'count'
        ]);


        if ($slot_selecionado === 0) {

            $this->tipo_msg = 'error';
            $this->msg = 'Você não pode desequipar o item, possivelmente voce não esta com o item equipado, ou tentou burlar o sistema..';
        } else if ($this->itens_bag < $this->max_bag) {

            DB::table('mochilas')
                ->where('id_personagem', '=', $this->id_personagem_select)
                ->where('status', '=', $this->remover_item)
                ->update(['status' => 0]);

            $this->tipo_msg = 'success';
            $this->msg = 'Item desequipado com sucesso, o item foi transferido para a sua mochila...';

        } else {
            $this->tipo_msg = 'error';
            $this->msg = 'Sua mochila esta cheia, aumente o espaço na sua mochila ou remova algum item dela';

        }


        $item_slot->session()->flash($this->tipo_msg, $this->msg);
        /*  return redirect('bag');*/
        return response()->json([$this->tipo_msg, $this->msg]);

    }

    public function venderItem(Request $id_item)
    {
        $bag_id = $id_item->id_bag_venda;

        $dados_personagem = $this->personagemRepository->personagem_status();

        foreach ($dados_personagem as $personagem) {
            $this->id_personagem_select = $personagem->id;
            $this->classe_personagem = $personagem->id_classe;
            $this->level_personagem = $personagem->level;

        }

        $verifica_item = $this->repository->selectID([
            'id_mochila' => $bag_id,
            'personagem' => $this->id_personagem_select
        ]);

        if (empty($verifica_item->id)) {
            $this->tipo_msg = 'error';
            $this->msg = 'Falha ao tentar vender o item, item não encontrado';

        }
        foreach ($verifica_item as $vender_item) {

            /* $valor_item = DB::table('items')
                 ->select('cols')
                 ->where('id', $vender_item->id_item)
                 ->get();*/

            $valor_item = $this->itemRepository->selectID(
                ['cols'],
                ['id_item' => $vender_item->id_item]);

            /*  $delete = DB::table('mochilas')
                  ->delete($bag_id);*/
            $delete = $this->repository->delete($bag_id);

            if ($delete) {
                foreach ($valor_item as $valor) {
                    DB::table('personagems')
                        ->increment('cols', $valor->cols);
                }
                $this->tipo_msg = 'success';
                $this->msg = 'Item vendido com sucesso!!!';
            } else {
                $this->tipo_msg = 'error';
                $this->msg = 'Falha ao tentar vender o item, tente novamente mais tarde.';

            }
        }

        $id_item->session()->flash($this->tipo_msg, $this->msg);
        /*  return redirect('bag');*/
        return response()->json([$this->tipo_msg, $this->msg]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Mochila deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Mochila deleted.');
    }
}
