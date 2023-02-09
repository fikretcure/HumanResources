<?php

namespace App\Enums;

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

}
