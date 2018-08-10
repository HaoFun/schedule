<?php

namespace App\Repositories;

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
        $model = $this->model();
        return $model instanceof Model ?
            $this->model = $model :
            abort(403);
    }

    public function all($columns = array('*'))
    {

    }

    public function paginate($perPage = 20, $columns = array('*'))
    {

    }

    public function create(array $data)
    {

    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {

    }

    public function find($id, $columns = array('*'))
    {

    }

    public function findBy($field, $value, $columns = array('*'))
    {

    }
}