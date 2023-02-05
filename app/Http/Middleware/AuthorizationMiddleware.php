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
class AuthorizationMiddleware
{
    use Responsed;

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (env("APP_ENV") == "local") {
            Auth::loginUsingId(1);
            return $next($request);
        }

        return $this->failMes("Yetki Geçersiz")->send(401);
    }
}
