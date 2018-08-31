<?php

namespace App\Services;

use App\Handlers\ResponseHandler;

abstract class BaseService implements ServiceInterface
{
    use ResponseHandler;

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

    public function showWith($with, $id, $column = ['*'])
    {
        return $this->repository->findWith($with, $id, $column);
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