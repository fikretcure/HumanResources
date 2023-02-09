<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitEndPointStoreRequest;
use App\Http\Requests\UnitEndPointUpdateRequest;
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
     * @param UnitEndPointStoreRequest $request
     * @return JsonResponse
     */
    public function store(UnitEndPointStoreRequest $request): JsonResponse
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
     * @param UnitEndPointUpdateRequest $request
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UnitEndPointUpdateRequest $request, $id): JsonResponse
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
