<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Repositories\UnitRepository;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 *
 */
class UnitController extends Controller
{

    /**
     * @var UnitRepository
     */
    private UnitRepository $unitRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->unitRepository = new UnitRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->unitRepository->index())->send();
    }

    /**
     * @param UnitStoreRequest $request
     * @return JsonResponse
     */
    public function store(UnitStoreRequest $request): JsonResponse
    {
        return $this->success($this->unitRepository->store($request->validated()))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->success($this->unitRepository->show($id))->send();
    }

    /**
     * @param UnitUpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UnitUpdateRequest $request, $id): JsonResponse
    {
        $this->unitRepository->update($request->validated(), $id);

        return $this->success()->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy($id): JsonResponse
    {
        return $this->success($this->unitRepository->destroy($id))->send();
    }

}
