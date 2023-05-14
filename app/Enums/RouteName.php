<?php

namespace App\Enums;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 *
 */
enum RouteName: string
{
    case auth_login = 'Kullanici Girisi';
    case auth_show = 'Oturum Gosterimi';
    case auth_logout = 'Oturum Kapatma';
    case setup = 'Database Kurulumu';
    case backup = 'Database Yedegi';

    /**
     * @return mixed
     */
    public static function statusNote(): mixed
    {
        if (Route::currentRouteName()) {
            $name = Str::replace('.', '_', Route::currentRouteName());
            return collect(self::cases())->first(function ($item) use ($name) {
                return $item->name == $name;
            })->value;
        }
        return Route::currentRouteName();
    }
}