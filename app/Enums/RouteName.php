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
    case auth_passwordReset = 'Sifre Yenileme';
    case auth_show = 'Oturum Gosterimi';
    case auth_logout = 'Oturum Kapatma';
    case setup = 'Database Kurulumu';
    case backup = 'Database Yedegi';
    case departments_index = 'Departmanlarin Listelenmesi';
    case departments_show = 'Departman Getirme';
    case departments_store = 'Departman Kaydi';
    case departments_update = 'Departman Guncelleme';
    case departments_destroy = 'Departman Silme';
    //
    case positions_index = 'Pozisyonlarin Listelenmesi';
    case positions_show = 'Pozisyon Getirme';
    case positions_store = 'Pozisyon Kaydi';
    case positions_update = 'Pozisyon Guncelleme';
    case positions_destroy = 'Pozisyon Silme';
    case histories_index = 'Aktivitelerin Listelenmesi';
    case histories_show = 'Aktivite Getirme';
    case histories_store = 'Aktivite Kaydi';
    case histories_update = 'Aktivite Guncelleme';
    case histories_destroy = 'Aktivite Silme';
    case users_membershipInvitations = 'Kullanici davet gonderimi';
    case users_subscriptionCompletion = 'Kullanici sifre tanimlamasi';

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
        return 'End Point Bulunamadı';
    }
}
