<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Process;

class BackUpController extends Controller
{
    public function __invoke(): \Illuminate\Foundation\Application|Response|JsonResponse|Application|ResponseFactory
    {
        if (env('APP_DEVICE') == 'development' or request()->bearerToken() == env('APP_KEY')) {
            $result = Process::run('cd .. && php artisan backup:run');
            return response($result->output());
        }
        return $this->fail()->send();
    }
}
