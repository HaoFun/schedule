<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract function model();

    public function makeModel()
    {
        $model = app()->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException(sprintf(config('exception.model_init_error'), $this->model()));
        }
        return $this->model = $model;
    }

    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function paginate($perPage = 20, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $attribute, $field = 'id')
    {
        if ($attribute instanceof Model) {
            return $attribute->update($data);
        }
        return $this->model->where($field, $attribute)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)->first($columns);
    }
}