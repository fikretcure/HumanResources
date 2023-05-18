<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    public Model $model;

    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }
}
