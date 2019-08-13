<?php

namespace App\Http\Controllers;

use App\Entities\Noticia;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpParser\Node\Stmt\TryCatch;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\NoticiaCreateRequest;
use App\Http\Requests\NoticiaUpdateRequest;
use App\Repositories\NoticiaRepository;
use App\Validators\NoticiaValidator;

/**
 * Class NoticiasController.
 *
 * @package namespace App\Http\Controllers;
 */
class NoticiasController extends Controller
{
    /**
     * @var NoticiaRepository
     */
    protected $noticias;
    private $tipo_msg;
    private $msg;

    /**
     * NoticiasController constructor.
     *
     * @param NoticiaRepository $repository
     */
    public function __construct(NoticiaRepository $noticias)
    {
        $this->noticias = $noticias;

    }

    public function index()
    {
        $noticias = $this->noticias->all('*');

        return view('admin.noticias.index')
            ->with('p_noticias', $noticias);
    }

    public function edit(Request $request)
    {
        try {
            $this->noticias->update_where([
                'titulo' => $request->titulo,
                'categoria' => $request->categoria,
                'data' => $request->data,
                'noticia' => $request->noticia], ['id_noticia' => $request->id_noticia]);


            $this->tipo_msg = 'success';
            $this->msg = 'Noticia alterada com sucesso';
        } catch (exception $noticia) {

            $this->tipo_msg = 'error';
            $this->msg .= 'Ocorreu um erro ao tentar alterar essa noticia, tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return response()->json([$this->tipo_msg, $this->msg]);

    }

    public function create(Request $request)
    {
        //dd($request);
        try {
            $this->noticias->create(
                $request->titulo,
                $request->noticia,
                $request->categoria,
                $request->data
            );
            $this->tipo_msg = 'success';
            $this->msg = 'Noticia criada com sucesso';
        } catch (exception $noticia) {
            $this->tipo_msg = 'error';
            $this->msg .= 'Ocorreu um erro ao tentar incluir uma nova noticia, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return response()->json([$this->tipo_msg, $this->msg]);
    }

    public function destroy(Request $request)
    {

        try {
            $this->noticias->delete($request->id_noticia);

            $this->tipo_msg = 'success';
            $this->msg = 'Noticia excluida com sucesso';
        } catch (exception $noticia) {

            $this->tipo_msg = 'error';
            $this->msg .= 'Ocorreu um erro ao tentar excluir a noticia, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return response()->json([$this->tipo_msg, $this->msg]);
    }


}
