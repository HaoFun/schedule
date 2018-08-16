<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Services\IssueService;

class IssueController extends Controller
{
    protected $service;

    const createFields = [
        'title', 'status', 'priority', 'created_date', 'due_date', 'created_by',
        'updated_by'
    ];
    const updateFields = [
        'title', 'status', 'priority', 'created_date', 'due_date', 'completed_date',
        'release_date', 'created_by', 'updated_by'
    ];

    public function __construct(IssueService $service)
    {
        $this->service = $service;
    }

    public function search(IssueRequest $request)
    {

    }

    public function history($id)
    {
        $response = $this->service->historyBy($id);
    }

    public function index()
    {
    }

    public function store(IssueRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::createFields)) ?
            $this->success(sprintf(trans('common.create_success'), trans('transformer.project'))) :
            $this->error(sprintf(trans('common.create_error'), trans('transformer.project')));
    }

    public function update(IssueRequest $request, Issue $issue)
    {
        return $this->service->modify(array_only($request->all(), self::updateFields), $issue) ?
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
