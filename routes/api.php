<?php

use App\Helpers\ServerInfoHelper;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackUpController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SetupController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::name("auth.")->controller(AuthController::class)->group(function () {
        Route::get('auth', 'auth')->name('show');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('positions', PositionController::class);
    Route::apiResource('histories', HistoryController::class);

    Route::apiResource('users', UserController::class);
    Route::post('users/membership-invitations', [UserController::class, 'membershipInvitations'])->name('users.membershipInvitations');
});

Route::post('setup', SetupController::class)->name('setup');
Route::post('backup', BackUpController::class)->name('backup');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');


Route::get('server', function () {
    return (new ServerInfoHelper())->toArray();
});
