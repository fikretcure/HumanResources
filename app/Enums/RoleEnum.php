<?php

namespace App\Enums;

enum RoleEnum: int
{
    case superAdmin = 1;
    case admin = 2;
    case person = 3;


    /**
     * @return array
     */
    public function detail(): array
    {
        return match ($this) {
            self::person => [
                "name" => "Personel",
                "value" => self::person->value,
            ],
            self::superAdmin => [
                "name" => "Süper Admin",
                "value" => self::superAdmin->value,
            ],
            self::admin => [
                "name" => "Admin",
                "value" => self::admin->value,
            ]
        };
    }

}
