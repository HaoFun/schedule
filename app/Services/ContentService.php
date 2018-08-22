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

    public function modify(array $data, $attribute)
    {
        if ($content = $this->repository->findWith('contentable', $attribute)) {
            return parent::modify($data, $content);
        }
        return false;
    }

    public function delete($id)
    {
        if ($content = $this->repository->find($id)) {
            return parent::delete($id);
        }
        return false;
    }
}