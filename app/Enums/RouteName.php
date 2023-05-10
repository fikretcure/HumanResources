<?php

namespace App\Enums;

use Illuminate\Support\Facades\Route;

/**
 *
 */
enum RouteName: string
{
    case auth = "Oturum";
    case login = "Girisi";
    case get = "Listeleme";
    case delete = "Silme";
    case update = "Güncelleme";
    case show = "Getirme";
    case create = "Ekleme";


    /**
     * @return mixed
     */
    public static function generateInfoMes(): mixed
    {
        return str()->of(Route::currentRouteName())->explode('.')->map(function ($name, $key) {
            return (collect(self::cases())->map(function ($item, $key) use ($name) {
                return $item->name == $name ? $item->value : false;
            })->filter())->first();
        })->implode(' ');
    }
}
