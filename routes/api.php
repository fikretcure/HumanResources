<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EndPointController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticationMiddleware;
use App\Http\Middleware\AuthorizationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return response()->json(str()->of(env("WEB_MES"))->explode(","));
})->name("home.index");


Route::middleware(AuthenticationMiddleware::class)->group(function () {
    Route::middleware(AuthorizationMiddleware::class)->group(function () {
        //
        Route::name("users.")->prefix('users')->controller(UserController::class)->group(function () {
            Route::name("index")->get(null, 'index');
            Route::name("store")->post(null, 'store');
            Route::name("show")->get("{id}", 'show');
            Route::name("update")->put("{id}", 'update');
            Route::name("destroy")->delete("{id}", 'destroy');
        });

        Route::apiResources([
            'units' => UnitController::class,
        ]);

        Route::name("endPoints.index")->get("end-points", EndPointController::class);
        //
    });
});

Route::name("users.passwordReset")->put("users/password-reset/{uuid}", [UserController::class, 'passwordReset'])->whereUuid("uuid");

Route::name("auth.")->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::name("login")->post("login", 'login');
    Route::name("checkToken")->post("check-token", 'checkToken');
});
