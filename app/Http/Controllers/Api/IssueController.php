<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueRequest;
use App\Http\Resources\IssueResourceCollection;
use App\Services\IssueService;

class IssueController extends Controller
{
    protected $service;

    const indexFields = ['title'];
    const createFields = [
        'project_id', 'title', 'status', 'priority', 'remark', 'type_id', 'start_date', 'due_date',
        'created_by', 'updated_by'
    ];
    const updateFields = [
        'project_id', 'title', 'status', 'priority', 'remark', 'type_id', 'start_date', 'due_date',
        'completed_date', 'release_date', 'created_by', 'updated_by'
    ];

    public function __construct(IssueService $service)
    {
        $this->service = $service;
    }

    public function search(IssueRequest $request)
    {
        return new IssueResourceCollection($this->service->search(20));
    }

    public function history($id)
    {
        $response = $this->service->historyBy($id);
        return new IssueResourceCollection($response ?? collect());
    }

    public function index()
    {
        return new IssueResourceCollection($this->service->index());
    }

    public function store(IssueRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::createFields)) ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.issue')), 201) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.issue')), 400);
    }

    public function update(IssueRequest $request, $id)
    {
        return $this->service->modify(array_only($request->all(), self::updateFields), $id) ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.issue'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.issue'), $id));
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ?
            $this->success($this->makeMessage('common.delete_success', trans('transformer.issue'), $id), 204) :
            $this->error($this->makeMessage('common.delete_error', trans('transformer.issue'), $id));
    }
}
