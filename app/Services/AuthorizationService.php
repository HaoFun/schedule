<?php

namespace App\Services;

use App\Repositories\AuthorizationRepository;

class AuthorizationService extends BaseService
{
    protected $repository;

    public function __construct(AuthorizationRepository $repository)
    {
        $this->repository = $repository;
    }
}