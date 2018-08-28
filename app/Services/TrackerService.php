<?php

namespace App\Services;

use App\Repositories\TrackerRepository;

class TrackerService extends BaseService
{
    protected $repository;

    public function __construct(TrackerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        if ($tracker = $this->repository->findWith(['issue', 'project'], $id)) {
            if ($tracker->issue->count() || $tracker->project->count()) {
                return $this->makeResponse(false, $this->makeMessage('common.delete_error_with_many',
                    trans('transformer.tracker'), $id , trans('transformer.issue'),
                    implode(',', $tracker->issue->pluck('title')->toArray()),
                    trans('transformer.project'), implode(',', $tracker->project->pluck('title')->toArray())), 400);
            }
            return $this->repository->delete($tracker) ?
                $this->makeResponse(true, $this->makeMessage('common.delete_success',
                    trans('transformer.tracker'), $id), 204):
                $this->makeResponse(false, $this->makeMessage('common.delete_error',
                    trans('transformer.tracker'), $id), 404);
        }
        return $this->makeResponse(false, $this->makeMessage('common.not_found_id',
            trans('transformer.tracker'), $id), 404);
    }
}