<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TypeRequest;
use App\Services\TypeService;

class TypeController extends BaseApiController
{
    protected $service;

    const defaultFields = [
        'type_name', 'type_info'
    ];

    public function __construct(TypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successWith(['types' => $this->service->index(self::defaultFields)]);
    }

    public function store(TypeRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::defaultFields)) ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.type')), 201) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.type')), 400);
    }

    public function show($id)
    {
        $type = $this->service->show($id);
        return $type ?
            $this->successWith(['type' => $type]) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.type'), $id));
    }

    public function update(TypeRequest $request, $id)
    {
        return $this->service->modify(array_only($request->all(), self::defaultFields), $id) ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.type'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.type'), $id));
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);
        return $response['status'] === true ?
            $this->success($response['message'], $response['code']) :
            $this->error($response['message'], $response['code']);
    }
}
