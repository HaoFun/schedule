<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all($columns = ['*']);

    public function paginate($perPage = 20, $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = ['*']);

    public function findBy($field, $value, $columns = ['*']);

    public function findWith($with, $id, $columns = ['*']);
}