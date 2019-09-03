<?php

namespace App\Http\Controllers;

use App\Repositories\MapaRepository;
use App\Repositories\PersonagemRepository;
use App\Repositories\QuestRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AndarCreateRequest;
use App\Http\Requests\AndarUpdateRequest;
use App\Repositories\AndarRepository;
use App\Validators\AndarValidator;

/**
 * Class AndarsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AndarsController extends Controller
{
    /**
     * @var AndarRepository
     */
    protected $repository;
    protected $validator;
    protected $personagemRepository;
    protected $mapaRepository;
    protected $questRepository;

    private $tipo_msg = '';
    private $msg = '';
    private $persoangem_andar;
    private $personagem_mapa;

    /**
     * AndarsController constructor.
     *
     * @param AndarRepository $repository
     * @param AndarValidator $validator
     */
    public function __construct(
        AndarRepository $repository,
        AndarValidator $validator,
        PersonagemRepository $personagemRepository,
        MapaRepository $mapaRepository,
        QuestRepository $questRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->personagemRepository = $personagemRepository;
        $this->mapaRepository = $mapaRepository;
        $this->questRepository = $questRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personagem = $this->personagemRepository->personagem_status();
        foreach ($personagem as $personagem_status) {
            $this->persoangem_andar = $personagem_status->id_andar;
            $this->personagem_mapa = $personagem_status->mapa;
        }

        $andar = $this->repository->selectID('*',
            [
                'andar' => $this->persoangem_andar
            ]);



        $mapa = $this->mapaRepository->selectID('*',
            [
                'id_andar' => $this->persoangem_andar,
                /* 'id' => $this->personagem_mapa*/
            ]);

            $quests = $this->questRepository->all('*',['id_andar'=>$this->persoangem_andar]);
        return view('andar.andar')
            ->with('andar_atual', $this->persoangem_andar)
            ->with('mapa', $mapa)
            ->with('andars', $andar)
            ->with('quests',$quests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AndarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AndarCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $andar = $this->repository->create($request->all());

            $response = [
                'message' => 'Andar created.',
                'data' => $andar->toArray(),
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
        $andar = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $andar,
            ]);
        }

        return view('andars.show', compact('andar'));
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
        $andar = $this->repository->find($id);

        return view('andars.edit', compact('andar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AndarUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AndarUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $andar = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Andar updated.',
                'data' => $andar->toArray(),
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
                'message' => 'Andar deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Andar deleted.');
    }
}
