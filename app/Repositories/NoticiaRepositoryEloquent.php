<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Noticia;
use App\Validators\NoticiaValidator;


/**
 * Class NoticiaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NoticiaRepositoryEloquent implements NoticiaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Noticia::class;
    }

    public function all($columns = ['*'])
    {
        $noticias = DB::table('noticias')
            ->select($columns)
            ->orderBy('data', 'desc')
            ->get();
        return $noticias;
    }

    public function update($field = ['*'])
    {
        $update = DB::table('noticias')
            ->update($field);
        return $update;
    }

    public function update_where($field = ['*'], $where = null)
    {

        $update = DB::table('noticias')
            ->where('id', '=', $where['id_noticia'])
            ->update($field);

        return $update;

    }

    public function create($titulo, $noticia, $categoria, $data)
    {
       // dd($categoria);
        $new_noticia = new Noticia;
        $new_noticia->titulo = $titulo;
        $new_noticia->noticia = $noticia;
        $new_noticia->categoria = $categoria;
        $new_noticia->data = $data;
        $new_noticia->save();

        return $new_noticia;
    }

    public function delete($id)
    {
        $noticia = DB::table('noticias')
            ->delete($id);

        return $noticia;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
