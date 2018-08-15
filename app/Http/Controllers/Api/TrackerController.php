<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackerRequest;
use App\Models\Tracker;
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
            $this->success(sprintf(trans('common.create_success'), trans('transformer.tracker'))) :
            $this->error(sprintf(trans('common.create_error'), trans('transformer.tracker')));
    }

    public function show(Tracker $tracker)
    {
        return $this->success($tracker->toArray());
    }

    public function update(TrackerRequest $request, Tracker $tracker)
    {
        return $this->service->modify(array_only($request->all(), self::defaultFields), $tracker) ?
            $this->success(sprintf(trans('common.modify_success'), trans('transformer.tracker'))) :
            $this->error(sprintf(trans('common.modify_error'), trans('transformer.tracker')));
    }

    public function destroy($id)
    {
        return $this->service->delete($id) ?
            $this->success(sprintf(trans('common.delete_success'), trans('transformer.tracker'), $id)) :
            $this->error(sprintf(trans('common.delete_error'), trans('transformer.tracker'), $id));
    }
}
