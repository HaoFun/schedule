<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $responseField = 'projects';
        if ($request->route()->getName() === 'projects.history') {
            $responseField = 'histories';
        }
        return ['data' => [$responseField => ProjectResource::collection($this->collection)]];
    }

    public function with($request)
    {
        return [
            'code' => 200,
            'message' => 'success',
            'status' => 'success'
        ];
    }
}
