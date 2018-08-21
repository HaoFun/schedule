<?php

namespace App\Services;


use App\Repositories\ContentRepository;

class ContentService extends BaseService
{
    protected $repository;

    public function __construct(ContentRepository $repository)
    {
        $this->repository = $repository;
    }
}