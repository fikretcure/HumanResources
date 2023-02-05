<?php

namespace App\Http\Middleware;

use App\Helpers\RequestMerge;
use App\Models\Token;
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
    public function handle(Request $request, Closure $next): JsonResponse//: JsonResponse
    {
        if (env("APP_ENV") == "local") {
            Auth::loginUsingId(1);
            return $next($request);
        }

        $token = Token::where("bearrer", $request->header("bearrer"))
            ->where("refresh", $request->header("refresh"))
            ->firstOrFail();


        if (now()->lessThanOrEqualTo($token->bearrer_expired_at)) {
            (new RequestMerge())->addToken($request->header("bearrer"), $request->header("refresh"));
            Auth::loginUsingId($token->user_id);

            return $next($request);
        }

        if (now()->lessThanOrEqualTo($token->refresh_expired_at)) {
            $bearrer = str()->uuid();
            (new RequestMerge())->addToken($bearrer, $request->header("refresh"));
            $token->update([
                "bearrer" => $bearrer,
                "bearrer_expired_at" => now()->addMinutes(5),
            ]);
            Auth::loginUsingId($token->user_id);

            return $next($request);
        }
        return $this->failMes("Token Geçersiz")->send(403);
    }
}
