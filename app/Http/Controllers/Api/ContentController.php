<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Services\ContentService;

class ContentController extends Controller
{
    protected $service;
    const updateFields = ['content', 'updated_by'];

    public function __construct(ContentService $service)
    {
        $this->service = $service;
    }

    public function show($id)
    {
        $content = $this->service->show($id);
        return $content ?
            $this->successWith(['content' => $content]) :
            $this->error($this->makeMessage('common.not_found_id', trans('transformer.content'), $id));
    }

    public function update(ContentRequest $request, $id)
    {
        $result = $this->service->modify(array_only($request->all(), self::updateFields), $id);
        return  $result ?
            $this->success($this->makeMessage('common.modify_success', trans('transformer.content'), $id)) :
            $this->error($this->makeMessage('common.modify_error', trans('transformer.content'), $id));
    }

    public function destroy($id)
    {
        $result = $this->service->delete($id);
        return $result ?
            $this->success($this->makeMessage('common.delete_success', trans('transformer.content'), $id), 204) :
            $this->error($this->makeMessage('common.delete_error', trans('transformer.content'), $id));
    }
}
