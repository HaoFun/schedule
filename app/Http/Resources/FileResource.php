<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fileable_id' => $this->fileable_id,
            'file_name' => $this->file_name,
            'file_path' => $this->file_path
        ];
    }
}
