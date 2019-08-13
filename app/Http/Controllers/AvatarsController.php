<?php

namespace App\Http\Controllers;

use App\Repositories\AvatarListRepository;
use App\Repositories\PersonagemRepository;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AvatarCreateRequest;
use App\Http\Requests\AvatarUpdateRequest;
use App\Repositories\AvatarRepository;
use App\Validators\AvatarValidator;

/**
 * Class AvatarsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AvatarsController extends Controller
{
    /**
     * @var AvatarRepository
     */
    protected $repository;
    protected $validator;
    protected $personagemRepository;
    protected $avatarListRepository;

    private $tipo_msg;
    private $msg;
    private $avatar_em_uso;


    /**
     * AvatarsController constructor.
     *
     * @param AvatarRepository $repository
     * @param AvatarValidator $validator
     * @param PersonagemRepository $personagemRepository
     * @param AvatarListRepository $avatarListRepository
     */
    public function __construct(
        AvatarRepository $repository,
        AvatarValidator $validator,
        PersonagemRepository $personagemRepository,
        AvatarListRepository $avatarListRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->personagemRepository = $personagemRepository;
        $this->avatarListRepository = $avatarListRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_nome = '';
        $avatars = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $avatars,
            ]);
        }

        return view('admin.avatars.avatar')
            ->with('avatars', $avatars)
            ->with('tipo_nome', $tipo_nome);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AvatarCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AvatarCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $avatar = $this->repository->create($request->all());

            $response = [
                'message' => 'Avatar created.',
                'data' => $avatar->toArray(),
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
        $avatar = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $avatar,
            ]);
        }

        return view('avatars.show', compact('avatar'));
    }

    public function create(Request $request)
    {
        ucfirst($request->avatar);
        if ($request->hasFile('img_avatar')) {
            $avatar_padrao = 'avatar-';
            $imageName = $avatar_padrao . $request->numero_avatar . '.png';
            $request->img_avatar->move(public_path('img/personagem/' . $request->avatar . '/'), $imageName);
        }

        if ($request->hasFile('img_face')) {
            $face_padrao = 'face.png';
            // $imageName = $avatar_padrao . $request->img_item->getClientOriginalName();
            $request->img_face->move(public_path('img/personagem/' . $request->avatar . '/'), $face_padrao);
        }

        if ($request->hasFile('img_select')) {
            $select_padrao = 'select.png';
            // $imageName = $avatar_padrao . $request->img_item->getClientOriginalName();
            $request->img_select->move(public_path('img/personagem/' . $request->avatar . '/'), $select_padrao);
        }

        Try {

            $this->repository->create(
                [
                    'avatar' => $request->avatar,
                    'tipo' => $request->tipo,
                    'descricao' => $request->descricao

                ]);

            $this->tipo_msg = 'success';
            $this->msg = 'Avatar criado com sucesso!!!';

        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;

        }
        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatar');
    }

    public function edit(Request $request)
    {
        ucfirst($request->avatar);
        if ($request->hasFile('img_avatar')) {
            $avatar_padrao = 'avatar-';
            $imageName = $avatar_padrao . $request->numero_avatar . '.png';
            $request->img_avatar->move(public_path('img/personagem/' . $request->avatar . '/'), $imageName);
        }

        if ($request->hasFile('img_face')) {
            $face_padrao = 'face.png';
            // $imageName = $avatar_padrao . $request->img_item->getClientOriginalName();
            $request->img_face->move(public_path('img/personagem/' . $request->avatar . '/'), $face_padrao);
        }

        if ($request->hasFile('img_select')) {
            $select_padrao = 'select.png';
            // $imageName = $avatar_padrao . $request->img_item->getClientOriginalName();
            $request->img_select->move(public_path('img/personagem/' . $request->avatar . '/'), $select_padrao);
        }

        Try {

            $this->repository->update_where(
                [
                    'avatar' => $request->avatar,
                    'tipo' => $request->tipo,
                    'descricao' => $request->descricao

                ],
                [
                    'id_avatar' => $request->id_avatar
                ]);

            $this->tipo_msg = 'success';
            $this->msg = 'Avatar alterado com sucesso!!!';

        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;

        }
        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatar');
    }


    public function update(AvatarUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $avatar = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Avatar updated.',
                'data' => $avatar->toArray(),
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
    public function destroy(Request $request)
    {
        /* dd($request);*/
        $this->avatar_em_uso = $this->personagemRepository->count_id(
            [
                'id_avatar'
            ],
            [
                'id_avatar' => $request->delete_id_avatar
            ]);

        if ($this->avatar_em_uso === 0) {
            try {
                $this->repository->delete($request->delete_id_avatar);
                $this->tipo_msg = 'success';
                $this->msg = 'Avatar deletado com sucesso!!!';
            } catch (exception $error) {

                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro: ' . $error;
            }
        } else {

            $this->tipo_msg = 'error';
            $this->msg = 'Este avatar esta em uso e não pode ser deletado...';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatar');
    }
}
