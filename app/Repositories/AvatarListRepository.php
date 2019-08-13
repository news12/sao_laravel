<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AvatarListRepository.
 *
 * @package namespace App\Repositories;
 */
interface AvatarListRepository
{
    public function all($columns = ['*']);

    public function select_avatar($fields = ['*'], $where = [null]);

    public function update_where($field = ['*'], $where = null);

    public function create($fields = [null]);

    public function delete($id);

    public function selectID($field, $where = [null]);

    public function count();
}
