<?php

namespace App\Http\Controllers;

use App\Repositories\AvatarRepository;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpParser\Node\Stmt\TryCatch;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AvatarListCreateRequest;
use App\Http\Requests\AvatarListUpdateRequest;
use App\Repositories\AvatarListRepository;
use App\Validators\AvatarListValidator;

/**
 * Class AvatarListsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AvatarListsController extends Controller
{
    /**
     * @var AvatarListRepository
     */
    protected $repository;
    protected $avatarRepository;

    private $tipo_msg;
    private $msg;
    private $nome_avatar;


    /**
     * AvatarListsController constructor.
     *
     * @param AvatarListRepository $repository
     */
    public function __construct(
        AvatarListRepository $repository,
        AvatarRepository $avatarRepository
    )
    {
        $this->repository = $repository;
        $this->avatarRepository = $avatarRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_nome = '';
        $avatarLists = $this->repository->all(
            [
                'avatar_lists.*',
                'avatars.avatar'
            ]);

        /* dd($avatarLists);*/
        return view('admin.avatars.avatarIMG')
            ->with('avatars', $avatarLists)
            ->with('tipo_nome', $tipo_nome);
    }

    public function create(Request $request)
    {

        Try {
            $this->repository->create(
                [
                    'id_avatar' => $request->id_avatar,
                    'tipo' => $request->tipo,
                    'numero_avatar' => $request->numero_avatar,
                    'status' => $request->status
                ]);

            if ($request->hasFile('img_avatar')) {

                $nome_avatar = $this->avatarRepository->selectID('avatar',
                    ['id' => $request->id_avatar]);

                foreach ($nome_avatar as $nome) {

                    $this->nome_avatar = $nome->avatar;
                }
                $avatar_padrao = 'avatar-';
                $imageName = $avatar_padrao . $request->numero_avatar . '.png';


                $request->img_avatar->move(public_path('img/personagem/' . $this->nome_avatar . '/'), $imageName);
            }

            $this->tipo_msg = 'success';
            $this->msg = 'Nova Imagem de avatar criado com sucesso!!!';

        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;
        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatarList');

    }


    public function edit(Request $request)
    {
        Try {
            $this->repository->update_where(
                [
                    'id_avatar' => $request->id_avatar,
                    'numero_avatar' => $request->numero_avatar,
                    'tipo' => $request->tipo,
                    'status' => $request->status
                ],
                [
                    'id' => $request->id
                ]);

            if ($request->hasFile('img_avatar')) {

                $nome_avatar = $this->avatarRepository->selectID('avatar',
                    ['id' => $request->id_avatar]);

                foreach ($nome_avatar as $nome) {

                    $this->nome_avatar = $nome->avatar;
                }
                $avatar_padrao = 'avatar-';
                $imageName = $avatar_padrao . $request->numero_avatar . '.png';


                $request->img_avatar->move(public_path('img/personagem/' . $this->nome_avatar . '/'), $imageName);
            }

            $this->tipo_msg = 'success';
            $this->msg = 'Imagem do avatar criado com sucesso!!!';

        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;

        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatarList');
    }


    public function update(AvatarListUpdateRequest $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        Try {
            $this->repository->delete($request->delete_img_avatar);

            $this->tipo_msg = 'success';
            $this->msg = 'Imagem do avatar deletada com sucesso!!!';
        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;


        }

        $request->session()->flash($this->tipo_msg, $this->msg);
        return redirect('alAvatarList');


    }
}
