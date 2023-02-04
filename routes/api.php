<?php

use App\Http\Controllers\UserController;
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
    return response()->json(env("WEB_MES"));
});

Route::name("users.")->prefix('users')->controller(UserController::class)->group(function () {
    Route::name("index")->get(null, 'index');
    Route::name("store")->post(null, 'store');
    Route::name("show")->get("{id}", 'show');
    Route::name("update")->put("{id}", 'update');
    Route::name("destroy")->delete("{id}", 'destroy');
    Route::name("passwordReset")->put("password-reset/{uuid}", 'passwordReset');
});
