<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoDropCreateRequest;
use App\Http\Requests\TipoDropUpdateRequest;
use App\Repositories\TipoDropRepository;
use App\Validators\TipoDropValidator;

/**
 * Class TipoDropsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoDropsController extends Controller
{
    /**
     * @var TipoDropRepository
     */
    protected $repository;

    /**
     * @var TipoDropValidator
     */
    protected $validator;

    /**
     * TipoDropsController constructor.
     *
     * @param TipoDropRepository $repository
     * @param TipoDropValidator $validator
     */
    public function __construct(TipoDropRepository $repository, TipoDropValidator $validator)
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
        $tipoDrops = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoDrops,
            ]);
        }

        return view('tipoDrops.index', compact('tipoDrops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoDropCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoDropCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoDrop = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoDrop created.',
                'data'    => $tipoDrop->toArray(),
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
        $tipoDrop = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoDrop,
            ]);
        }

        return view('tipoDrops.show', compact('tipoDrop'));
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
        $tipoDrop = $this->repository->find($id);

        return view('tipoDrops.edit', compact('tipoDrop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoDropUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoDropUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoDrop = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoDrop updated.',
                'data'    => $tipoDrop->toArray(),
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
                'message' => 'TipoDrop deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoDrop deleted.');
    }
}
