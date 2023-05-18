<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository extends Repository
{
    public Model $model;

    public function __construct()
    {
        $this->model = new Department();
        parent::__construct($this->model);
    }
}
