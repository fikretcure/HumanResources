<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordResetRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Jobs\UserStoreMailJob;
use App\Repositories\PasswordResetRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Throwable;

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
     * @var PasswordResetRepository
     */
    private PasswordResetRepository $passwordResetRepository;

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     *
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->passwordResetRepository = new PasswordResetRepository();
        $this->userService = new UserService();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->userRepository->index())->send();
    }

    /**
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $createdData = $this->userRepository->store($request->validated());
        $token = (string)str()->uuid();
        $this->passwordResetRepository->store([
            "email" => $request->validated("email"),
            "token" => $token,
            "expired_at" => now()->addHours(2)
        ]);
        UserStoreMailJob::dispatch($request->validated() + ["token" => $token]);

        return $this->success($createdData)->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->success("test")->send();

    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $this->userService->checkSuperAdmin($id);
        $this->userRepository->update($request->validated(), $id);

        return $this->success()->send();

    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy($id): JsonResponse
    {
        $this->userService->checkSuperAdmin($id);

        return $this->success("test")->send();
    }

    /**
     * @param UserPasswordResetRequest $request
     * @param $uuid
     * @return JsonResponse
     * @throws Throwable
     */
    public function passwordReset(UserPasswordResetRequest $request, $uuid): JsonResponse
    {
        $passwordReset = $this->passwordResetRepository->show($uuid);
        $this->userRepository->update([
            "password" => $request->input("password")
        ], $passwordReset->user->id);

        return $this->success()->send();

    }
}
