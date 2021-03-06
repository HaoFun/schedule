<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;

class DepartmentController extends BaseApiController
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
            $this->success($this->makeMessage('common.create_success', trans('transformer.department')), 201) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.department')), 400);
    }

    public function show($id)
    {
        $department = $this->service->show($id);
        return $department ?
            $this->successWith(['department' => $department]) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.department'), $id));
    }

    public function update(DepartmentRequest $request, $id)
    {
        return $this->service->modify(array_only($request->all(), self::defaultFields), $id) ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.department'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.department'), $id));
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);
        return $response['status'] === true ?
            $this->success($response['message'], $response['code']) :
            $this->error($response['message'], $response['code']);
    }
}
