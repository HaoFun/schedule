<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResourceCollection;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $service;

    const titleFields = ['title'];
    const defaultFields = [

    ];

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return new ProjectResourceCollection($this->service->paginate(20, ['title']));
    }

    public function search(ProjectRequest $request)
    {
        return new ProjectResourceCollection($this->service->search());
    }

    public function store(ProjectRequest $request)
    {
        dd($request);
    }
}
