<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{

    public function login(LoginAuthRequest $request)
    {
        Auth::loginUsingId(1);
        $token = $request->user()->createToken('api');
        return ['token' => $token->plainTextToken];
    }
}
