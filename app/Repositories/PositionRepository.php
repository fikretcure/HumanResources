<?php

namespace App\Repositories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository extends Repository
{
    public Model $model;

    public function __construct()
    {
        $this->model = new Position();
        parent::__construct($this->model);
    }

    /**
     * @return Builder[]|Collection
     */
    public function detail(): Collection|array
    {
        return $this->model->with('department')->get();
    }
}
