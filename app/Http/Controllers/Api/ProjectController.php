<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResourceCollection;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $service;

    const titleFields = ['title'];
    const createFields = [
        'title', 'status', 'priority', 'created_date', 'due_date', 'created_by',
        'updated_by'
    ];
    const updateFields = [
        'title', 'status', 'priority', 'created_date', 'due_date', 'completed_date',
        'release_date', 'created_by', 'updated_by'
    ];

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function search(ProjectRequest $request)
    {
        return new ProjectResourceCollection($this->service->search());
    }

    public function history($id)
    {
        $response = $this->service->historyBy($id);
        return new ProjectResourceCollection($response ?? collect());
    }

    public function index()
    {
        return new ProjectResourceCollection($this->service->paginate(20, self::titleFields));
    }

    public function store(ProjectRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::createFields)) ?
            $this->success(sprintf(trans('common.create_success'), trans('transformer.project'))) :
            $this->error(sprintf(trans('common.create_error'), trans('transformer.project')));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        return $this->service->modify(array_only($request->all(), self::updateFields), $project) ?
            $this->success(sprintf(trans('common.modify_success'), trans('transformer.project'))) :
            $this->error(sprintf(trans('common.modify_error'), trans('transformer.project')));
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ?
            $this->success(sprintf(trans('common.delete_success'), trans('transformer.project'), $id)) :
            $this->error(sprintf(trans('common.delete_error'), trans('transformer.project'), $id));
    }
}
