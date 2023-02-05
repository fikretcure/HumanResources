<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\User;
use Exception;
use Throwable;

/**
 *
 */
class UserService
{

    /**
     * @param $id
     * @return void
     * @throws Throwable
     */
    public function checkSuperAdmin($id): void
    {
        throw_if($id == RoleEnum::superAdmin->value, Exception::class, 'Süper Admin Üzerinde İşlem Yapamazsınız !');
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserFromEmail($email): mixed
    {
        return User::whereEmail($email)->firstOrFail()->makeVisible('password');
    }

}
