<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EquipeCreateRequest;
use App\Http\Requests\EquipeUpdateRequest;
use App\Repositories\EquipeRepository;
use App\Validators\EquipeValidator;

/**
 * Class EquipesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EquipesController extends Controller
{
    /**
     * @var EquipeRepository
     */
    protected $repository;

    /**
     * @var EquipeValidator
     */
    protected $validator;

    /**
     * EquipesController constructor.
     *
     * @param EquipeRepository $repository
     * @param EquipeValidator $validator
     */
    public function __construct(EquipeRepository $repository, EquipeValidator $validator)
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
        $equipes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $equipes,
            ]);
        }

        return view('equipes.index', compact('equipes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EquipeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EquipeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $equipe = $this->repository->create($request->all());

            $response = [
                'message' => 'Equipe created.',
                'data'    => $equipe->toArray(),
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
        $equipe = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $equipe,
            ]);
        }

        return view('equipes.show', compact('equipe'));
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
        $equipe = $this->repository->find($id);

        return view('equipes.edit', compact('equipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EquipeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EquipeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $equipe = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Equipe updated.',
                'data'    => $equipe->toArray(),
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
                'message' => 'Equipe deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Equipe deleted.');
    }
}
