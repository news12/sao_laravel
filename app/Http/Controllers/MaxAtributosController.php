<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MaxAtributoCreateRequest;
use App\Http\Requests\MaxAtributoUpdateRequest;
use App\Repositories\MaxAtributoRepository;
use App\Validators\MaxAtributoValidator;

/**
 * Class MaxAtributosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MaxAtributosController extends Controller
{
    /**
     * @var MaxAtributoRepository
     */
    protected $repository;

    /**
     * @var MaxAtributoValidator
     */
    protected $validator;

    /**
     * MaxAtributosController constructor.
     *
     * @param MaxAtributoRepository $repository
     * @param MaxAtributoValidator $validator
     */
    public function __construct(MaxAtributoRepository $repository, MaxAtributoValidator $validator)
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
        $maxAtributos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maxAtributos,
            ]);
        }

        return view('maxAtributos.index', compact('maxAtributos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MaxAtributoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MaxAtributoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $maxAtributo = $this->repository->create($request->all());

            $response = [
                'message' => 'MaxAtributo created.',
                'data'    => $maxAtributo->toArray(),
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
        $maxAtributo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $maxAtributo,
            ]);
        }

        return view('maxAtributos.show', compact('maxAtributo'));
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
        $maxAtributo = $this->repository->find($id);

        return view('maxAtributos.edit', compact('maxAtributo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MaxAtributoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MaxAtributoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $maxAtributo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MaxAtributo updated.',
                'data'    => $maxAtributo->toArray(),
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
                'message' => 'MaxAtributo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MaxAtributo deleted.');
    }
}
