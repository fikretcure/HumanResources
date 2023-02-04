<?php

namespace App\Repositories;


use App\Models\PasswordReset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class PasswordResetRepository extends Repository
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
        $this->model = PasswordReset::query();
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
            attributes: $attributes
        );
    }


}
