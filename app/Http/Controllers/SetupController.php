<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

/**
 *
 */
class SetupController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function __invoke()
    {
        if (env('APP_DEVICE') == 'development' or request()->bearerToken() == env('APP_KEY')) {
            $result = Process::run('bash setup.sh');
            return $result->output();
        }
        return response()->json(false, 404);
    }
}
