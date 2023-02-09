<?php

namespace App\Enums;

use App\Http\Middleware\AuthenticationMiddleware;
use Illuminate\Support\Facades\Route;

/**
 *
 */
enum RouteNameEnum: string
{
    case users = "Kullanıcı";
    case passwordReset = "Şifre Güncelleme";
    case auth = "Hesap";
    case endPoints = "İşlem";
    case units = "Birim";
    case unitEndPoints = "Birim İşlev";

    case login = "Girişi";

    case index = "Listeleme";
    case store = "Ekleme";
    case show = "Gösterme";
    case update = "Güncelleme";
    case destroy = "Silme";


    /**
     * @param $name
     * @return mixed
     */
    public static function generateInfoMes($name): mixed
    {
        return str()->of(str()->camel($name))->explode('.')->map(function ($name, $key) {
            return (collect(self::cases())->map(function ($item, $key) use ($name) {
                return $item->name == $name ? $item->value : false;
            })->filter())->first();
        })->implode(' ');
    }

    /**
     * @return mixed
     */
    public static function getRouteNames(): mixed
    {
        return collect(Route::getRoutes()->get())->map(function ($item, $key) {
            if (collect($item->action)->has("middleware")) {
                if (collect($item->action["middleware"])->contains(AuthenticationMiddleware::class)) {
                    return [
                        "slug" => $item->action["as"],
                        "name" => RouteNameEnum::generateInfoMes($item->action["as"])
                    ];
                }
            }
            return null;
        })->filter()->values();
    }

}
