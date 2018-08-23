<?php

namespace App\Services;

use App\Handlers\MakeResponseTransHandler;
use App\Repositories\TypeRepository;

class TypeService extends BaseService
{
    use MakeResponseTransHandler;

    protected $repository;

    public function __construct(TypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        if ($type = $this->repository->findWith('issue', $id)) {
            if ($type->issue->count()) {
                return $this->makeResponse(false, $this->makeMessage('common.delete_error_with',
                    trans('transformer.type'), $id , trans('transformer.issue'),
                    implode(',', $type->issue->pluck('title')->toArray())), 400);
            }
            return $this->repository->delete($type) ?
                $this->makeResponse(true, $this->makeMessage('common.delete_success',
                    trans('transformer.type'), $id), 204):
                $this->makeResponse(false, $this->makeMessage('common.delete_error',
                    trans('transformer.type'), $id), 404);
        }
        return $this->makeResponse(false, $this->makeMessage('common.not_found_id',
            trans('transformer.type'), $id), 404);
    }
}