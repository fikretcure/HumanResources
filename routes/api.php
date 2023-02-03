<?php

use Illuminate\Http\Request;
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

Route::name("users.")->prefix('authors')->controller(AuthorController::class)->group(function () {
    Route::name("index")->get(null, 'index');
    Route::name("store")->post(null, 'store');
    Route::name("show")->get("{id}", 'show');
    Route::name("update")->delete("{id}", 'update');
    Route::name("destroy")->put("{id}", 'destroy');
});
