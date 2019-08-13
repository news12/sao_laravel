<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MapaCreateRequest;
use App\Http\Requests\MapaUpdateRequest;
use App\Repositories\MapaRepository;
use App\Validators\MapaValidator;

/**
 * Class MapasController.
 *
 * @package namespace App\Http\Controllers;
 */
class MapasController extends Controller
{
    /**
     * @var MapaRepository
     */
    protected $repository;

    /**
     * @var MapaValidator
     */
    protected $validator;

    /**
     * MapasController constructor.
     *
     * @param MapaRepository $repository
     * @param MapaValidator $validator
     */
    public function __construct(MapaRepository $repository, MapaValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $mapas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mapas,
            ]);
        }

        return view('mapas.index', compact('mapas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MapaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MapaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mapa = $this->repository->create($request->all());

            $response = [
                'message' => 'Mapa created.',
                'data'    => $mapa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
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
        $mapa = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mapa,
            ]);
        }

        return view('mapas.show', compact('mapa'));
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
        $mapa = $this->repository->find($id);

        return view('mapas.edit', compact('mapa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MapaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MapaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mapa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Mapa updated.',
                'data'    => $mapa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
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
                'message' => 'Mapa deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Mapa deleted.');
    }
}
