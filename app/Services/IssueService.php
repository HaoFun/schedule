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

    public function modify(array $data, $attribute)
    {
        if ($issue = $this->repository->find($attribute)) {
            return parent::modify(array_merge($data, [
                'updated_at' => now()
            ]), $issue);
        }
        return false;
    }
}