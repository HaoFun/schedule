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

    public function modify(array $data, $attribute)
    {
        if ($project = $this->repository->find($attribute)) {
            return parent::modify(array_merge($data, [
                'updated_at' => now()
            ]), $project);
        }
        return false;
    }
}