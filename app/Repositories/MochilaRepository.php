<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MochilaRepository.
 *
 * @package namespace App\Repositories;
 */
interface MochilaRepository
{
    public function selectID($where =[null]);

    public function selectSlotBag($columns = ['*'], $where = [null]);
    public function selectSlotPerso($columns = ['*'], $where = [null]);

    public function all($columns = ['*'], $where = [null]);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null,$requisitor = null);

    public function create($fields = [null]);

    public function delete($id);
}
