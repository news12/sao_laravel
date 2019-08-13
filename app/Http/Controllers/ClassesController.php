<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ClasseCreateRequest;
use App\Http\Requests\ClasseUpdateRequest;
use App\Repositories\ClasseRepository;
use App\Validators\ClasseValidator;

/**
 * Class ClassesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ClassesController extends Controller
{
    /**
     * @var ClasseRepository
     */
    protected $repository;

    /**
     * @var ClasseValidator
     */
    protected $validator;

    /**
     * ClassesController constructor.
     *
     * @param ClasseRepository $repository
     * @param ClasseValidator $validator
     */
    public function __construct(ClasseRepository $repository, ClasseValidator $validator)
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
        $classes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $classes,
            ]);
        }

        return view('classes.index', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClasseCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClasseCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $classe = $this->repository->create($request->all());

            $response = [
                'message' => 'Classe created.',
                'data'    => $classe->toArray(),
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
        $classe = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $classe,
            ]);
        }

        return view('classes.show', compact('classe'));
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
        $classe = $this->repository->find($id);

        return view('classes.edit', compact('classe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClasseUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClasseUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $classe = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Classe updated.',
                'data'    => $classe->toArray(),
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
                'message' => 'Classe deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Classe deleted.');
    }
}
