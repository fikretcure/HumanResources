<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Process;

/**
 *
 */
class SetupController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        if (env('APP_DEVICE') == 'development' or request()->bearerToken() == env('APP_KEY')) {
            $result = Process::run('cd .. && php artisan migrate:fresh --seed --force');
            return $this->success(($result->output()))->send();
        }
        return $this->fail()->send();
    }
}
