<?php

namespace App\Http\Middleware;

use App\Traits\Responsed;
use Closure;
use Illuminate\Http\Request;

/**
 *
 */
class AuthorizationMiddleware
{
    use Responsed;


    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
