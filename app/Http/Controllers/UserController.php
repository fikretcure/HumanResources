<?php

namespace App\Http\Controllers;


use App\Http\Requests\MembershipInvitationsUserRequest;
use App\Http\Requests\SubscriptionCompletionUserRequest;
use App\Mail\AuthLoginShipped;
use App\Mail\MembershipInvitationsShipped;
use App\Models\MembershipInvitations;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

/**
 *
 */
class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('role:super_admin|hr_admin')->only('membershipInvitations');
        $this->userRepository = new UserRepository();
    }

    /**
     * @param MembershipInvitationsUserRequest $request
     * @return JsonResponse
     */
    public function membershipInvitations(MembershipInvitationsUserRequest $request): JsonResponse
    {
        collect($request->users)->each(function ($item, $key) {
            MembershipInvitations::whereEmail($item['email'])->delete();
            $user = MembershipInvitations::create($item + ['token' => uniqid(), 'expired_at' => now()->addHours(2)]);
            Mail::to($item['email'])->queue(new MembershipInvitationsShipped($user));
        });
        return $this->ok();
    }

    /**
     * @param SubscriptionCompletionUserRequest $request
     * @return JsonResponse
     */
    public function subscriptionCompletion(SubscriptionCompletionUserRequest $request): JsonResponse
    {
        $token = MembershipInvitations::whereToken($request->token)->first();
        User::create($token->toArray() + $request->only('password') + ['status' => true]);
        $token->delete();
        return $this->ok($token->expired_at);
    }
}
