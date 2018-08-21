<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Services\ContentService;

class ContentController extends Controller
{
    protected $service;

    public function __construct(ContentService $service)
    {
        $this->service = $service;
    }

    public function show($id)
    {
        $content = $this->service->show($id);
        return $content ?
            $this->success($content) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.content'), $id));
    }

    public function update(ContentRequest $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
