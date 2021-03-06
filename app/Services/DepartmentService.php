<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService extends BaseService
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        if ($department = $this->repository->findWith('user', $id)) {
            if ($department->user->count()) {
                return $this->makeResponse(false, $this->makeMessage('common.delete_error_with',
                    trans('transformer.department'), $id , trans('transformer.user'),
                    implode(',', $department->user->pluck('account')->toArray()), 400));
            }
            return $this->repository->delete($id) ?
                $this->makeResponse(true, $this->makeMessage('common.delete_success',
                    trans('transformer.department'), $id), 204):
                $this->makeResponse(false, $this->makeMessage('common.delete_error',
                    trans('transformer.department'), $id), 400);
        }
        return $this->makeResponse(false, $this->makeMessage('common.not_found_id',
            trans('transformer.department'), $id), 404);
    }
}