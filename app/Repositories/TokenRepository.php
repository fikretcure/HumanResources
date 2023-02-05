<?php

namespace App\Repositories;


use App\Models\Token;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class TokenRepository extends Repository
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
        $this->model = Token::query();
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
