<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = "active";
    case PASSIVE = "passive";


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
