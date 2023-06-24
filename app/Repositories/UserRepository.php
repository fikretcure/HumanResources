<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class UserRepository extends Repository
{
    /**
     * @var Model|User
     */
    public Model|User $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return $this->model->firstWhere('email', $email);
    }


    /**
     * @param $per_page
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function paginate($per_page = null)
    {
        $model = $this->model;
        if (request()->has('order_by')) {
            $model = $model->orderBy(request()->get('order_by'), request()->has('sort') ? request()->get('sort') : 'asc');
        }
        if (request()->has('keyword')) {
            $model->OrWhere('name', 'like', '%' . request()->get('keyword') . '%');
            $model->OrWhere('surname', 'like', '%' . request()->get('keyword') . '%');
            $model->OrWhere('email', 'like', '%' . request()->get('keyword') . '%');
            $model->OrWhere('status', 'like', '%' . request()->get('keyword') . '%');
            $model->OrWhere('sex', 'like', '%' . request()->get('keyword') . '%');
            $model->OrWhere(DB::raw('CONCAT(name, " ", surname)'), 'like', '%' . request()->get('keyword') . '%');
            //
            $with = $this->model->withWhereHas('position', function ($query) {
                $query->where('name', 'like', '%' . request()->get('keyword') . '%');
            })->pluck('id');
            $model->OrWhereIn('id', $with);
            //
            $with_2 = $this->model->withWhereHas('position.department', function ($query) {
                $query->where('name', 'like', '%' . request()->get('keyword') . '%');
            })->pluck('id');

            $model->OrWhereIn('id', $with_2);
        }

        return $model->paginate($per_page);
    }
}
