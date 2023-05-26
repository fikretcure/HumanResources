<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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
