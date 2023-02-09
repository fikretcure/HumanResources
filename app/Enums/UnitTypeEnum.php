<?php

namespace App\Enums;

enum UnitTypeEnum : int
{
    case DEPARTMENT = 1;
    case POSITION = 0;

    /**
     * @return array
     */
    public function detail(): array
    {
        return match ($this) {
            self::DEPARTMENT => [
                "type" => "Departman",
                "value" => self::DEPARTMENT->value,
            ],
            self::POSITION => [
                "type" => "Pozisyon",
                "value" => self::POSITION->value,
            ]
        };
    }
}
