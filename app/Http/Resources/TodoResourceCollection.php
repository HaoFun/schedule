<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return ['data' => [ 'todos' => TodoResource::collection($this->collection)]];
    }

    public function with($request)
    {
        return [
            'message' => 'success',
        ];
    }
}
