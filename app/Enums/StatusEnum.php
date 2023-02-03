<?php

namespace App\Enums;

enum StatusEnum: int
{
    case ACTIVE = 1;
    case PASSIVE = 0;


    public function detail(): array
    {
        return match ($this) {
            self::ACTIVE => [
                "name" => "Aktif",
                "thema" => "success",
                "value" => self::ACTIVE->value
            ],
            self::PASSIVE => [
                "name" => "Pasif",
                "thema" => "warning",
                "value" => self::PASSIVE->value
            ]

        };
    }

}
