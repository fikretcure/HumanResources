<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;

/**
 *
 */
class SetupController extends Controller
{


    /**
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|JsonResponse|Response
     */
    public function __invoke(): \Illuminate\Foundation\Application|Response|JsonResponse|Application|ResponseFactory
    {
        if (env('APP_DEVICE') == 'development' or request()->bearerToken() == env('APP_KEY')) {
            $result = Process::run('cd .. && php artisan migrate:fresh --seed --force');
            DB::commit();
            return response($result->output());
        }
        return $this->error();
    }
}
