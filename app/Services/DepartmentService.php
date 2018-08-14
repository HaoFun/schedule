<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService extends BaseService
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }
}