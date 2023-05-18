<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
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
        $this->departmentRepository = new DepartmentRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->departmentRepository->all())->send();
    }


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
        return $this->success($department)->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
