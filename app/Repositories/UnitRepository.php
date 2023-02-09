<?php

namespace App\Repositories;


use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class UnitRepository extends Repository
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
        $this->model = Unit::query();
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

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function show(int $id): Model|Collection|Builder|array
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     */
    public function destroy(int $id): mixed
    {
        return $this->model->findOrFail($id)->delete();
    }

}
