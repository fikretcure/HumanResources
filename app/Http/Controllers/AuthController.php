<?php

namespace App\Http\Controllers;

use App\Helpers\ServerInfoHelper;
use App\Http\Requests\ForgotPasswordAuthRequest;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\SetPasswordAuthRequest;
use App\Mail\AuthLoginShipped;
use App\Mail\ForgotPasswordShipped;
use App\Mail\PasswordErrorShipped;
use App\Models\PasswordResetToken;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $server = (new ServerInfoHelper())->toArray();
        if (Auth::attempt($request->only('email', 'password'))) {

            $token = Token::create([
                    'user_id' => Auth::id(),
                    'type' => $request->device,
                    'token' => env('APP_NAME') . now() . (string)str()->uuid()
                ] + $server);
            Mail::to($request->email)->queue(new AuthLoginShipped($server + ['date' => now()]));
            return $this->ok($token->token);
        }

        if (User::whereEmail($request->email)->exists()) {
            Mail::to($request->email)->queue(new PasswordErrorShipped($server + ['date' => now()] + request()->all()));
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

    /**
     * @param ForgotPasswordAuthRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordAuthRequest $request)
    {
        DB::table('password_reset_tokens')->updateOrInsert(
            [
                'email' => $request->input('email')
            ],
            [
                'token' => uniqid(),
                'created_at' => now()
            ]
        );
        $passwordRestTokens = DB::table('password_reset_tokens')->whereEmail($request->input('email'))->first();

        Mail::to($request->input('email'))->queue(new ForgotPasswordShipped(collect($passwordRestTokens)->toArray()));
        return $this->ok();
    }


    /**
     * @param SetPasswordAuthRequest $request
     * @return JsonResponse
     */
    public function setPassword(SetPasswordAuthRequest $request)
    {
        $password = PasswordResetToken::whereToken($request->token)->latest()->first();
        if (now()->greaterThan($password->created_at->addDays(7))) {
            PasswordResetToken::whereToken($request->token)->delete();
            return $this->error('Token suresi dolmustur');
        }
        PasswordResetToken::whereToken($request->token)->delete();

        $user = User::whereEmail($password->email)->first();

        $user->update([
            'password' => $request->input('password')
        ]);
        return $this->ok();
    }
}
