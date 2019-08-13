<?php

namespace App\Http\Controllers;

use App\Repositories\ClasseRepository;
use App\Repositories\GrauItemRepository;
use App\Repositories\MochilaRepository;
use App\Repositories\TipoDropRepository;
use App\Repositories\TipoItemRepository;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Repositories\ItemRepository;
use App\Validators\ItemValidator;

/**
 * Class ItemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ItemsController extends Controller
{
    /**
     * @var ItemRepository
     */
    protected $repository;
    protected $classeRepository;
    protected $tipoItemRepository;
    protected $tipoDropRepository;
    protected $grauItemRepository;
    protected $mochilaRepository;
    private $tipo_msg;
    private $msg;
    private $grau_name;

    /**
     * @var ItemValidator
     */
    protected $validator;

    /**
     * ItemsController constructor.
     *
     * @param ItemRepository $repository
     * @param ItemValidator $validator
     */
    public function __construct(
        ItemRepository $repository,
        ItemValidator $validator,
        ClasseRepository $classeRepository,
        TipoItemRepository $tipoItemRepository,
        TipoDropRepository $tipoDropRepository,
        GrauItemRepository $grauItemRepository,
        MochilaRepository $mochilaRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->classeRepository = $classeRepository;
        $this->tipoItemRepository = $tipoItemRepository;
        $this->tipoDropRepository = $tipoDropRepository;
        $this->grauItemRepository = $grauItemRepository;
        $this->mochilaRepository = $mochilaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = $this->repository->all(['items.*', 'classes.classe', 'grau_items.nome as grau']);
        $classes = $this->classeRepository->all('*');
        $grau_item = $this->grauItemRepository->all('*');
        $tipo_Item = $this->tipoItemRepository->all('*');
        $tipo_Drop = $this->tipoDropRepository->all('*');

        return view('admin.itens.item')
            ->with('itens', $items)
            ->with('classes', $classes)
            ->with('grauItem', $grau_item)
            ->with('tipoItem', $tipo_Item)
            ->with('tipoDrop', $tipo_Drop);
    }

    public function edit(Request $request)
    {
        $grau_item = $this->grauItemRepository->selectID($request->id_grau_item);
        foreach ($grau_item as $grau) {
            $this->grau_name = $grau->nome;
        }

        if ($request->hasFile('img_item')) {
            $imageName = $request->img_item->getClientOriginalName();
            $request->img_item->move(public_path('img/itens/' . $this->grau_name), $imageName);
        }

        try {
            $this->repository->update_where([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'level' => $request->level,
                'id_classe' => $request->id_classe,
                'for' => $request->for,
                'int' => $request->int,
                'agi' => $request->agi,
                'def' => $request->def,
                'res' => $request->res,
                'esp' => $request->esp,
                'evo' => $request->evo,
                'mag' => $request->mag,
                'energia' => $request->energia,
                'vida' => $request->vida,
                'cols' => $request->cols,
                'cash' => $request->cash,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'id_tipo_drop' => $request->id_tipo_drop,
                'id_tipo_item' => $request->id_tipo_item,
                'id_grau_item' => $request->id_grau_item,
                'id_avatar' => $request->id_avatar
            ], ['id_item' => $request->id_item]);
            $this->tipo_msg = 'success';
            $this->msg = 'Item alterado com sucesso!!!';
        } catch (exception $item) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $item . ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alItem');

        /* return response()->json([$this->tipo_msg, $this->msg]);*/
    }

    public function create(Request $request)
    {
        $grau_item = $this->grauItemRepository->selectID($request->id_grau_item);
        foreach ($grau_item as $grau) {
            $this->grau_name = $grau->nome;
        }
        if ($request->hasFile('img_item')) {
            $imageName = $request->img_item->getClientOriginalName();
            $request->img_item->move(public_path('img/itens/' . $this->grau_name), $imageName);
        }
        try {
            $this->repository->create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'level' => $request->level,
                'id_classe' => $request->id_classe,
                'for' => $request->for,
                'int' => $request->int,
                'agi' => $request->agi,
                'def' => $request->def,
                'res' => $request->res,
                'esp' => $request->esp,
                'evo' => $request->evo,
                'mag' => $request->mag,
                'energia' => $request->energia,
                'vida' => $request->vida,
                'cols' => $request->cols,
                'cash' => $request->cash,
                'data_inicio' => $request->data_inicio,
                'data_fim' => $request->data_fim,
                'id_tipo_drop' => $request->id_tipo_drop,
                'id_tipo_item' => $request->id_tipo_item,
                'id_grau_item' => $request->id_grau_item,
                'id_avatar' => $request->id_avatar,
            ]);
            $this->tipo_msg = 'success';
            $this->msg = 'Item criado com sucesso!!!';
        } catch (exception $item) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $item . ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return redirect('alItem');
    }


    public function destroy(Request $request)
    {

        try {
            $item_vinculado_personagem = $this->mochilaRepository->selectID(
                [
                    'id_item' => $request->id_item,
                    'delete_panel_admin' => 'yes'
                ]);

            if ($item_vinculado_personagem > 0) {
                $this->tipo_msg = 'error';
                $this->msg = 'Esse item não pode ser deletado pois existem personagens com esse item na bag';
            } else {
                $this->repository->delete($request->id_item);

                $this->tipo_msg = 'success';
                $this->msg = 'Item excluido com sucesso';
            }
        } catch (exception $erros) {

            $this->tipo_msg = 'error';
            $this->msg .= 'Ocorreu o seguinte erro: ' . $erros;

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return response()->json([$this->tipo_msg, $this->msg]);
    }
}
