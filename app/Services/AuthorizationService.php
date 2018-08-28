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

    public function modify(array $data, $attribute)
    {
        if ($user = $this->repository->find($attribute)) {
            return parent::modify($data, $user);
        }
        return false;
    }
}