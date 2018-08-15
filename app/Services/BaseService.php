<?php

namespace App\Services;

abstract class BaseService implements ServiceInterface
{
    protected $repository;

    public function index($column = ['*'])
    {
        return $this->repository->all($column);
    }

    public function paginate($perPage = 20, $column = ['*'])
    {
        return $this->repository->paginate($perPage, $column);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function show($id, $column = ['*'])
    {
        return $this->repository->find($id, $column);
    }

    public function modify(array $data, $attribute)
    {
        return $this->repository->update($data, $attribute);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}