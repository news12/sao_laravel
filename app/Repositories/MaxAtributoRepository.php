<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MaxAtributoRepository.
 *
 * @package namespace App\Repositories;
 */
interface MaxAtributoRepository
{
    public function all($columns = ['*']);
}
