<?php

namespace App\Repositories;

use App\Entities\Noticia;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NoticiaRepository.
 *
 * @package namespace App\Repositories;
 */
interface NoticiaRepository
{
    public function all($columns = ['*']);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null);

    public function create($titulo, $noticia, $categoria, $data);

    public function delete($id);
}
