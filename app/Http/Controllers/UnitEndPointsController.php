<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitStoreRequest;
use App\Http\Requests\UnitUpdateRequest;
use App\Repositories\UnitEndpointRepository;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 *
 */
class UnitEndPointsController extends Controller
{

    /**
     * @var UnitEndpointRepository
     */
    private UnitEndpointRepository $baseRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->baseRepository = new UnitEndpointRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->baseRepository->index())->send();
    }

    /**
     * @param UnitStoreRequest $request
     * @return JsonResponse
     */
    public function store(UnitStoreRequest $request): JsonResponse
    {
        return $this->success($this->baseRepository->store($request->validated()))->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->success($this->baseRepository->show($id))->send();
    }

    /**
     * @param UnitUpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UnitUpdateRequest $request, $id): JsonResponse
    {
        $this->baseRepository->update($request->validated(), $id);

        return $this->success()->send();
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy($id): JsonResponse
    {
        return $this->success($this->baseRepository->destroy($id))->send();
    }

}
