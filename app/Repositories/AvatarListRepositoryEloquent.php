<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvatarListRepository;
use App\Entities\AvatarList;
use App\Validators\AvatarListValidator;

/**
 * Class AvatarListRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AvatarListRepositoryEloquent implements AvatarListRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AvatarList::class;
    }

    public function select_avatar($fields = ['*'], $where = [null])
    {
        $dados = DB::table('avatar_lists')
            ->select($fields)
            ->where($where)
            ->get();

        return $dados;
    }

    public function create($fields = [null])
    {
        $new_avatar = new AvatarList;
        $new_avatar->id_avatar = $fields['id_avatar'];
        $new_avatar->numero_avatar = $fields['numero_avatar'];
        $new_avatar->tipo = $fields['tipo'];
        $new_avatar->save();

        return $new_avatar;
    }

    public function update_where($field = ['*'], $where = null)
    {
        $dados = DB::table('avatar_lists')
            ->where('id', '=', $where['id'])
            ->update($field);

        return $dados;
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('avatar_lists')
            ->select($columns)
            ->leftJoin('avatars', 'avatar_lists.id_avatar', '=', 'avatars.id')
            ->orderBy('avatar', 'desc')
            ->get();
        return $dados;
    }

    public function delete($id)
    {
        $dados = DB::table('avatar_lists')
            ->delete($id);

        return $dados;
    }

    public function selectID($field, $where = [null])
    {
        // TODO: Implement selectID() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }


    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
