<?php

namespace App\Repositories;



/**
 * Interface QuestRepository.
 *
 * @package namespace App\Repositories;
 */
interface QuestRepository
{
    public function all($columns = ['*']);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null);

    public function create($fields = [null]);

    public function delete($id);

    public function selectID($field, $where = [null]);

    public function count();
}
