<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{


    /**
     * @param LoginAuthRequest $request
     * @return \Illuminate\Contracts\Auth\Authenticatable|string|null
     */
    public function login(LoginAuthRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            return Auth::user();
        }
        return 'Giris bilgisi hatali';
    }
}
