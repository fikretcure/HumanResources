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
            return $this->success(auth()->user()->getRoleNames())->mes($request->user()->createToken($request->device)->plainTextToken)->send();
        }
        return $this->fail()->mes('Kullanici bilgilerinizi kontrol etmelisiniz')->send();
    }

    /**
     * @return JsonResponse
     */
    public function auth(): JsonResponse
    {
        return $this->successSend(\auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        return $this->success(request()->user()->tokens()->delete())->send();
    }
}
