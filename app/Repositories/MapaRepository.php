<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MapaRepository.
 *
 * @package namespace App\Repositories;
 */
interface MapaRepository
{
    public function all($columns = ['*']);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null);

    public function create($fields = [null]);

    public function delete($id);

    public function selectID($field, $where = [null]);

    public function count();
}
