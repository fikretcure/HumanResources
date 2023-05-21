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
        return $this->successSendPagination(DepartmentResource::collection($this->departmentRepository->paginate()));
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        return $this->successSend($this->departmentRepository->create($request->validated()));
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department): JsonResponse
    {
        return $this->successSend(DepartmentResource::make($department));
    }

    /**
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->departmentRepository->update($department->id, $request->validated());
        return $this->successSend($department->refresh());
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function destroy(Department $department): JsonResponse
    {
        return $this->successSend($department->delete());
    }
}
