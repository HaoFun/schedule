<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResourceCollection;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $service;

    const indexFields = ['title'];
    const createFields = [
        'title', 'status', 'priority', 'remark', 'created_date', 'due_date', 'created_by',
        'updated_by'
    ];
    const updateFields = [
        'title', 'status', 'priority', 'remark', 'created_date', 'due_date', 'completed_date',
        'release_date', 'created_by', 'updated_by'
    ];

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function search(ProjectRequest $request)
    {
        return new ProjectResourceCollection($this->service->search(20));
    }

    public function history($id)
    {
        $response = $this->service->historyBy($id);
        return new ProjectResourceCollection($response ?? collect());
    }

    public function index()
    {
        return new ProjectResourceCollection($this->service->index(self::indexFields));
    }

    public function store(ProjectRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::createFields)) ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.project'))) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.project')));
    }

    public function update(ProjectRequest $request, $id)
    {
        return $this->service->modify(array_only($request->all(), self::updateFields), $id) ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.project'))) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.project')));
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ?
            $this->success($this->makeMessage('common.delete_success', trans('transformer.project'), $id)) :
            $this->error($this->makeMessage('common.delete_error', trans('transformer.project'), $id));
    }
}
