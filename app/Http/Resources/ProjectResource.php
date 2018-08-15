<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($request->route()->getName()) {
            case 'projects.index' : {
                return [
                    'title' => $this->title
                ];
            }
            default : {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'status' => $this->status,
                    'remark' => $this->remark,
                    'created_date' => $this->created_date,
                    'due_date' => $this->due_date,
                    'completed_date' => $this->completed_date,
                    'release_date' => $this->release_date,
                    'files_count' => $this->files_count,
                    'contents_count' => $this->contents_count,
                    'issues_count' => $this->issues_count,
                    'manager' => $this->user->pluck('account'),
                    'tracker' => $this->tracker->pluck('tracker_name'),
                    'created_by' => optional($this->created_by_user)->account,
                    'updated_by' => optional($this->updated_by_user)->account
                ];
            }
        }
    }
}
