<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class DepartmentController extends Controller
{

    /**
     * @var DepartmentRepository
     */
    private DepartmentRepository $departmentRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('role:super_admin|hr_admin')->only('update', 'store', 'destroy');
        $this->departmentRepository = new DepartmentRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (request()->has('per_page')) {
            return $this->okPaginate(DepartmentResource::collection($this->departmentRepository->paginate()));
        }

        return $this->ok(DepartmentResource::collection($this->departmentRepository->all()));
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        return $this->ok($this->departmentRepository->create($request->validated()));
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department): JsonResponse
    {
        return $this->ok(DepartmentResource::make($department));
    }

    /**
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->departmentRepository->update($department->id, $request->validated());
        return $this->ok($department->refresh());
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function destroy(Department $department): JsonResponse
    {
        return $this->ok($department->delete());
    }
}
