<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $responseField = $request->route()->getName() === 'projects.history' ? 'histories' : 'projects';
        return ['data' => [$responseField => ProjectResource::collection($this->collection)]];
    }
}
