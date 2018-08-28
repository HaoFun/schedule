<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class IssueResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $responseField = 'issues';
        if ($request->route()->getName() === 'issues.history') {
            $responseField = 'histories';
        }
        return ['data' => [$responseField => IssueResource::collection($this->collection)]];
    }

    public function with($request)
    {
        return [
            'message' => 'success'
        ];
    }
}
