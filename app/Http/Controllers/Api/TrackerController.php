<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackerRequest;
use App\Services\TrackerService;

class TrackerController extends Controller
{
    protected $service;

    const defaultFields = [
        'tracker_name', 'tracker_info'
    ];

    public function __construct(TrackerService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successWith(['trackers' => $this->service->index(self::defaultFields)]);
    }

    public function store(TrackerRequest $request)
    {
        return $this->service->create(array_only($request->all(), self::defaultFields)) ?
            $this->success($this->makeMessage('common.create_success', trans('transformer.tracker'))) :
            $this->error($this->makeMessage('common.create_error', trans('transformer.tracker')));
    }

    public function show($id)
    {
        $tracker = $this->service->show($id);
        return $tracker ?
            $this->success($tracker) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.tracker'), $id));
    }

    public function update(TrackerRequest $request, $id)
    {
        return $this->service->modify(array_only($request->all(), self::defaultFields), $id) ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.tracker'))) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.tracker')));
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);
        return $response['status'] === true ?
            $this->success($response['message']) :
            $this->error($response['message']);
    }
}
