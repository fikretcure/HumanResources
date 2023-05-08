<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Process;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/setup', function () {
    if (env('APP_DEVICE') == 'development') {
        $result = Process::run('cd .. && bash import_v2.sh');
        return $result->output();

    } else {
        if (request()->bearerToken() == env('APP_KEY')) {
            $result = Process::run('cd .. && bash import.sh');
            return $result->output();
        }
        return response()->json(false, 404);
    }
});

Route::get('/composer', function () {
    $result = Process::run('cd .. && bash composer.sh');
    return [$result->output(),$result->errorOutput()];
});

Route::post('login', [AuthController::class, 'login']);
