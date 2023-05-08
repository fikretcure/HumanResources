<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class AuthController extends Controller
{

    public function login(Request $request)
    {
        Auth::loginUsingId(1);
        $token = $request->user()->createToken('api');
        return ['token' => $token->plainTextToken];
    }
}
