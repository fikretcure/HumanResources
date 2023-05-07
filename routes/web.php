<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json('Welcome' . ' ' . env('APP_NAME') . ' ' . 'Api');
});



Route::get('/setup', function () {
    $result = Process::run('cd .. && bash import.sh');
    return $result->output();
});
