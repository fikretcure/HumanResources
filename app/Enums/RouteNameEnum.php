<?php

namespace App\Enums;

use Illuminate\Support\Facades\Route;

/**
 *
 */
enum RouteNameEnum: string
{
    case users = "Kullanıcı";
    case passwordReset = "Şifre Güncelleme";

    case index = "Listeleme";
    case store = "Ekleme";
    case show = "Gösterme";
    case update = "Güncelleme";
    case destroy = "Silme";


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
