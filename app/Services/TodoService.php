<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService extends BaseService
{
    protected $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search()
    {
        return $this->repository->search();
    }

    public function create(array $data)
    {
        data_get($data, 'start_date') ?
            null :
            data_set($data, 'start_date', now());
        return parent::create($data);
    }

    public function toggle($id)
    {
        if ($todo = $this->repository->find($id)) {
            return $this->repository->update([
                'is_done' => $todo->is_done === 1 ? 0 : 1
            ], $todo);
        }
        return false;
    }
}