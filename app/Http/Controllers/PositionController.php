<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class PositionController extends Controller
{

    /**
     * @var PositionRepository
     */
    private PositionRepository $positionRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('role:super_admin|hr_admin')->only('update', 'store', 'destroy');
        $this->positionRepository = new PositionRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (request()->has('detail')) {
            return $this->okPaginate(PositionResource::collection($this->positionRepository->paginate()));
        }

        return $this->ok($this->positionRepository->all());
    }

    /**
     * @param StorePositionRequest $request
     * @return JsonResponse
     */
    public function store(StorePositionRequest $request): JsonResponse
    {
        return $this->ok($this->positionRepository->create($request->validated()));
    }

    /**
     * @param Position $position
     * @return JsonResponse
     */
    public function show(Position $position): JsonResponse
    {
        return $this->ok($position);
    }

    /**
     * @param UpdatePositionRequest $request
     * @param Position $position
     * @return JsonResponse
     */
    public function update(UpdatePositionRequest $request, Position $position): JsonResponse
    {
        $this->positionRepository->update($position->id, $request->validated());
        return $this->ok($position->refresh());
    }

    /**
     * @param Position $position
     * @return JsonResponse
     */
    public function destroy(Position $position): JsonResponse
    {
        return $this->ok($position->delete());
    }
}
