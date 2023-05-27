<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Mail\AuthLoginShipped;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 *
 */
class AuthController extends Controller
{

    /**
     * @param LoginAuthRequest $request
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            Mail::to($request->email)->queue(new AuthLoginShipped());
            return $this->ok($request->user()->createToken($request->device)->plainTextToken);
        }
        return $this->error('Kullanici bilgilerinizi kontrol etmelisiniz');
    }

    /**
     * @return JsonResponse
     */
    public function auth(): JsonResponse
    {
        return $this->ok(\auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->ok(request()->user()->tokens()->delete());
    }
}
