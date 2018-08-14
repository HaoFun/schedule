<?php

namespace App\Services;

interface ServiceInterface
{
    public function index($column = ['*']);

    public function create(array $data);

    public function show($id, $column = ['*']);

    public function modify(array $data, $id);

    public function delete($id);
}