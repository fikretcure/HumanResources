<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;

class PositionRepository extends Repository
{
    public Model $model;

    public function __construct()
    {
        $this->model = new Position();
        parent::__construct($this->model);
    }
}
