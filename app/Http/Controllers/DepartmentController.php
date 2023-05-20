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
        $data = DepartmentResource::collection($this->departmentRepository->all());

        return $this->success($data)->send();


        if (request()->has('detail')) {
            return $this->success($this->departmentRepository->detail())->send();
        }

        return $this->success($this->departmentRepository->all())->send();
    }

    /**
     * @param StoreDepartmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        return $this->success($this->departmentRepository->create($request->validated()))->send();
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function show(Department $department): JsonResponse
    {
        return $this->success(DepartmentResource::make($department))->send();
     }

    /**
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->departmentRepository->update($department->id, $request->validated());
        return $this->success($department->refresh())->send();
    }

    /**
     * @param Department $department
     * @return JsonResponse
     */
    public function destroy(Department $department): JsonResponse
    {
        return $this->success($department->delete())->send();
    }
}
