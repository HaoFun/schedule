<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    protected $service;

    const defaultFields = [
        'department_name', 'department_info'
    ];

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successWith(['departments' => $this->service->index(self::defaultFields)]);
    }

    public function store(DepartmentRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::defaultFields)) ?
            $this->success(sprintf(trans('common.create_success'), 'Department')) :
            $this->error(sprintf(trans('common.create_error'), 'Department'));
    }

    public function show(Department $department)
    {
        return $this->success($department->toArray());
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        return $this->service->modify(array_only($request->all(), self::defaultFields), $department) ?
            $this->success(sprintf(trans('common.modify_success'), 'Department')) :
            $this->error(sprintf(trans('common.modify_error'), 'Department'));
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ?
            $this->success(sprintf(trans('common.delete_success'), 'Department', $id)) :
            $this->error(sprintf(trans('common.delete_error'), 'Department', $id));
    }
}
