<?php

namespace App\Services;

use App\Repositories\TrackerRepository;

class TrackerService extends BaseService
{
    protected $repository;

    public function __construct(TrackerRepository $repository)
    {
        $this->repository = $repository;
    }
}