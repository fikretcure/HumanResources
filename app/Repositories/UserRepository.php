<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

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
}
