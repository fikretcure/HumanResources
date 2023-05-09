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
        if (Auth::attempt($request->only('email','password'))) {
            return $request->user()->createToken($request->device)->plainTextToken;
        }
        return response()->json('Giris bilgilerinizi kontrol etmelisiniz !', 403);
    }


    public function auth()
    {
        return \auth()->user();
    }
}
