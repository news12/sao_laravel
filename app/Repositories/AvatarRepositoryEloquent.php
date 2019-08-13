<?php

namespace App\Repositories;

use App\Entities\AvatarList;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvatarRepository;
use App\Entities\Avatar;
use App\Validators\AvatarValidator;

/**
 * Class AvatarRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AvatarRepositoryEloquent implements AvatarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Avatar::class;
    }

    public function selectID($field, $where = [null])
    {
        $dados = DB::table('avatars')
            ->select($field)
            ->where($where)
            ->get();

        return $dados;
    }

    public function delete($id)
    {
        $dados = DB::table('avatars')
            ->delete($id);

        return $dados;
    }

    public function all($columns = ['*'])
    {
        $dados = DB::table('avatars')
            ->select($columns)
            ->orderBy('avatar', 'desc')
            ->get();
        return $dados;
    }

    public function create($fields = [null])
    {
        $new_avatar = new AvatarList;
        $new_avatar->id_avatar = $fields['id_avatar'];
        $new_avatar->tipo = $fields['tipo'];
        $new_avatar->numero_avatar = $fields['numero_avatar'];
        $new_avatar->status = $fields['status'];
        $new_avatar->save();

        return $new_avatar;
    }

    public function count()
    {
        $dados = DB::table('avatars')
            ->select('id')
            ->count();

        return $dados;
    }

    public function update($field = ['*'])
    {
        // TODO: Implement update() method.
    }

    public function update_where($field = ['*'], $where = null)
    {
        $dados = DB::table('avatars')
            ->where('id', '=', $where['id_avatar'])
            ->update($field);

        return $dados;
    }

    public function validator()
    {

        return AvatarValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
