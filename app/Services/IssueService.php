<?php

namespace App\Services;

use App\Repositories\IssueRepository;

class IssueService extends BaseService
{
    protected $repository;

    public function __construct(IssueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search($fields = ['*'])
    {
        return $this->repository->search($fields);
    }

    public function historyBy($id)
    {
        return $this->repository->historyBy($id);
    }
}