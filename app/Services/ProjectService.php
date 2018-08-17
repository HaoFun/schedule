<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService extends BaseService
{
    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search($perpage = 20, $fields = ['*'])
    {
        return $this->repository->search($perpage, $fields);
    }

    public function historyBy($id)
    {
        return $this->repository->historyBy($id);
    }
}