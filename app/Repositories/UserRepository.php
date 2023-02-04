<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class UserRepository extends Repository
{
    /**
     * @var Builder
     */
    private Builder $model;

    /**
     *
     */
    public function __construct()
    {
        $this->model = User::query();
    }

    /**
     * @return array|Collection
     */
    public function index(): array|Collection
    {
        return $this->model->get();
    }

    /**
     * @param array $attributes
     * @return Model|Builder
     */
    public function store(array $attributes): Builder|Model
    {
        return $this->model->create(
            attributes: ["reg_code" => $this->generateRegCode(User::class)] + $attributes
        );
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool|int
     */
    public function update(array $attributes, int $id): bool|int
    {
        return $this->model->findOrFail($id)->update($attributes);
    }


}
