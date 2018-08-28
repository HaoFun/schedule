<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResourceCollection;
use App\Services\TodoService;

class TodoController extends BaseApiController
{
    protected $service;

    const defaultFields = [
        'user_id', 'is_done', 'todo', 'start_date', 'due_date'
    ];
    const updateFields = [
        'is_done', 'todo', 'start_date', 'due_date'
    ];

    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    public function search(TodoRequest $request)
    {
        return new TodoResourceCollection($this->service->search());
    }

    public function show($id)
    {
        $todo = $this->service->show($id);
        return $todo ?
            $this->successWith(['todo' => $todo]) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.todo'), $id));
    }

    public function store(TodoRequest $request)
    {
        $result = $this->service->create(array_only($request->all(), self::defaultFields));
        return $result ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.todo')), 201) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.todo')), 400);
    }

    public function update(TodoRequest $request, $id)
    {
        $result = $this->service->modify(array_only($request->all(), self::updateFields), $id);
        return $result ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.todo'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.todo'), $id));
    }

    public function toggle($id)
    {
        $result = $this->service->toggle($id);
        return $result ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.todo'), $id)) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.todo'), $id));
    }
}
