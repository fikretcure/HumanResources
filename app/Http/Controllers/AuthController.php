<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{


    public function login(LoginAuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return $request->user()->createToken('api')->plainTextToken;
        }
        return response()->json('Giris bilgilerinizi kontrol etmelisiniz !', 403);
    }
}
