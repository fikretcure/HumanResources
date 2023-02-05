<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Mail\AuthLoginShipped;
use App\Repositories\TokenRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


/**
 *
 */
class AuthController extends Controller
{

    /**
     * @var TokenRepository
     */
    private TokenRepository $tokenRepository;

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     *
     */
    public function __construct()
    {
        $this->tokenRepository = new TokenRepository();
        $this->userService = new UserService();
    }

    /**
     * @param AuthLoginRequest $request
     * @return JsonResponse
     */
    public function login(AuthLoginRequest $request): JsonResponse
    {
        $user = $this->userService->getUserFromEmail($request->input("email"));

        if (Hash::check($request->password, $user->password)) {
            $bearrer = str()->uuid();
            $refresh = str()->uuid();
            $request->merge([
                'bearrer' => $bearrer,
                'refresh' => $refresh,
            ]);
            $this->tokenRepository->store([
                "bearrer" => $bearrer,
                "bearrer_expired_at" => now()->addMinutes(5),
                "refresh" => $refresh,
                "refresh_expired_at" => now()->addHours(1),
                "user_id" => $user->id
            ]);
            Mail::to($request->input("email"))->queue(new AuthLoginShipped($user));

            return $this->success()->send();
        }
        return $this->failMes("Giriş Bilgileriniz Hatalıdır !")->send();
    }
}
