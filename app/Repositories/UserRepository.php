<?php

namespace App\Repositories;

use App\Exceptions\LoginException;
use App\Helpers\ServerInfoHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserRepository extends Repository
{
    public Model $model;

    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }

    /**
     * @param $email
     * @return mixed
     * @throws LoginException
     * @throws Throwable
     */
    public function getUserByEmail($email): mixed
    {
        $user = $this->model->firstWhere('email', $email);
        throw_unless($user, LoginException::class);
        return $user;
    }

    public function createToken($user)
    {
        $user->token()->delete();
        return $user->token()->create([
                'token' => Hash::make(str()->uuid())
            ] + (new ServerInfoHelper())->handle())->token;
    }

}
