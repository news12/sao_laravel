<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PersonagemRepository.
 *
 * @package namespace App\Repositories;
 */
interface PersonagemRepository
{

    public function personagem_id();

    public function personagem_pontos();

    public function personagem_avatar();

    public function create($fields = [null]);

    public function update($field = ['*']);

    public function update_where($field = ['*'], $where = null);

    public function inc($field, $valor);

    public function dec($field, $valor);

    public function personagem_id_classe($id_personagem);

    public function personagem_status();

    public function count_id($field = ['*'], $where = [null]);
}
