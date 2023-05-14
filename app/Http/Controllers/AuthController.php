<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

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
                return $this->success($request->user()->createToken($request->device)->plainTextToken)->send();
            }
            return $this->failMes('Kullanici bilgilerinizi kontrol etmelisiniz')->send();
    }

    /**
     * @return JsonResponse
     */
    public function auth(): JsonResponse
    {
        return $this->success(\auth()->user())->send();
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->success(request()->user()->tokens()->delete())->send();
    }
}
