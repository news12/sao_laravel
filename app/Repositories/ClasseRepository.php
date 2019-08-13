<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ClasseRepository.
 *
 * @package namespace App\Repositories;
 */
interface ClasseRepository
{
    public function all($columns = ['*']);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null);

    public function create($fields = [null]);

    public function delete($id);
}
