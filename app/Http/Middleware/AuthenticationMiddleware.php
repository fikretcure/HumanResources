<?php

namespace App\Http\Middleware;

use App\Traits\Responsed;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticationMiddleware
{
    use Responsed;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (Response|RedirectResponse)  $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {

        if(env("APP_ENV")=="local"){
            return $next($request);

        }

        return $this->failMes("Token Geçersiz")->send(403);

    }
}
