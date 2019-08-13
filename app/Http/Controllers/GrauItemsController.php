<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GrauItemCreateRequest;
use App\Http\Requests\GrauItemUpdateRequest;
use App\Repositories\GrauItemRepository;
use App\Validators\GrauItemValidator;

/**
 * Class GrauItemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GrauItemsController extends Controller
{
    /**
     * @var GrauItemRepository
     */
    protected $repository;

    /**
     * @var GrauItemValidator
     */
    protected $validator;

    /**
     * GrauItemsController constructor.
     *
     * @param GrauItemRepository $repository
     * @param GrauItemValidator $validator
     */
    public function __construct(GrauItemRepository $repository, GrauItemValidator $validator)
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
        $grauItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $grauItems,
            ]);
        }

        return view('grauItems.index', compact('grauItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GrauItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GrauItemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $grauItem = $this->repository->create($request->all());

            $response = [
                'message' => 'GrauItem created.',
                'data'    => $grauItem->toArray(),
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
        $grauItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $grauItem,
            ]);
        }

        return view('grauItems.show', compact('grauItem'));
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
        $grauItem = $this->repository->find($id);

        return view('grauItems.edit', compact('grauItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GrauItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GrauItemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $grauItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'GrauItem updated.',
                'data'    => $grauItem->toArray(),
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
                'message' => 'GrauItem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'GrauItem deleted.');
    }
}
