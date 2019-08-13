<?php

namespace App\Http\Controllers;

use App\Repositories\AndarRepository;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QuestCreateRequest;
use App\Http\Requests\QuestUpdateRequest;
use App\Repositories\QuestRepository;
use App\Validators\QuestValidator;

/**
 * Class QuestsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QuestsController extends Controller
{

    protected $repository;
    protected $andarRepository;

    private $tipo_msg;
    private $msg;


    public function __construct(QuestRepository $repository,
                                AndarRepository $andarRepository)
    {
        $this->repository = $repository;
        $this->andarRepository = $andarRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quests = $this->repository->all();
        $andars = $this->andarRepository->all();

//dd($quests);
        return view('admin.quests.quest')
            ->with('quests', $quests)
            ->with('andars', $andars);
    }

    public function create(Request $request)
    {
        // dd($request);

        if ($request->hasFile('img_quest')) {
            $imageName = $request->img_quest->getClientOriginalName();
            $request->img_quest->move(public_path('img/quests/'), $imageName);
        }
        try {
            $this->repository->create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'level' => $request->level,
                'guild' => $request->guild,
                'boss' => $request->boss,
                'status' => $request->status,
                'cols' => $request->cols,
                'exp' => $request->exp,
                'itens' => $request->itens,
                'andar' => $request->id_andar,
            ]);
            $this->tipo_msg = 'success';
            $this->msg = 'Item criado com sucesso!!!';
        } catch (exception $quest) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $quest . ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return redirect('alQuest');
    }


    public function edit(Request $request)
    {
        if ($request->hasFile('img_quest')) {
            $imageName = $request->img_quest->getClientOriginalName();
            $request->img_quest->move(public_path('img/quests/'), $imageName);
        }

        try {
            $this->repository->update_where([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'level' => $request->level,
                'guild' => $request->guild,
                'boss' => $request->boss,
                'status' => $request->status,
                'cols' => $request->cols,
                'exp' => $request->exp,
                'itens' => $request->itens,
                'andar' => $request->id_andar
            ], ['id_quest' => $request->id_quest]);
            $this->tipo_msg = 'success';
            $this->msg = 'Quest alterada com sucesso!!!';
        } catch (exception $quest) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $quest . ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alQuest');
    }

    public function destroy(Request $request)
    {

        try {
            $this->repository->delete($request->delete_quest);
            $this->tipo_msg = 'success';
            $this->msg = 'Quest Deletada com sucesso!!!';
        } catch (exception $quest) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $quest . ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alQuest');
    }

}
