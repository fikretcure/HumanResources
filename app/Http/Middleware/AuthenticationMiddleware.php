<?php

namespace App\Http\Middleware;

use App\Traits\Responsed;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthenticationMiddleware
{
    use Responsed;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (env("APP_ENV") == "local") {
            Auth::loginUsingId(1);
            return $next($request);
        }

        return $this->failMes("Token Geçersiz")->send(403);
    }
}
