<?php

namespace App\Http\Middleware;

use App\Helpers\ServerInfoHelper;
use App\Models\Token;
use App\Models\User;
use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = Token::where('token', $request->bearerToken())->first();
        if ($token) {
            $server = (new ServerInfoHelper())->toArray();
            if ($token->http_user_agent == $server['http_user_agent'] and $token->remote_addr == $server['remote_addr'] and $token->server_addr == $server['server_addr']) {
                Auth::loginUsingId($token->user_id);
                return $next($request);
            } else {
                return $this->error('Gecersiz anahtar !');


            }

        }
        return $this->error('Gecersiz anahtar !');


    }
}
