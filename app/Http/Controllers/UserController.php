<?php

namespace App\Http\Controllers;


use App\Http\Requests\MembershipInvitationsUserRequest;
use App\Http\Requests\SubscriptionCompletionUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Mail\MembershipInvitationsShipped;
use App\Models\MembershipInvitations;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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
        $this->middleware('role:super_admin|hr_admin')->only('membershipInvitations', 'update');
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
        if ($token->expired_at->lessThan(now())) {
            $token->delete();
            return $this->error();

        } else {
            User::create($token->toArray() + $request->only('password') + ['status' => true]);
            $token->delete();
            return $this->ok();
        }
    }

    /**
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): JsonResponse
    {
        if (request()->has('per_page')) {
            return $this->okPaginate(UserResource::collection($this->userRepository->paginate()));
        }
        return $this->ok(UserResource::collection($this->userRepository->all()));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->ok(UserResource::make($user));
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->userRepository->update($user->id, collect($request->validated())->except('roles')->toArray());
        $user->syncRoles($request->roles);

        return $this->ok(UserResource::make($user->refresh()));
    }
}
