<?php

namespace App\Http\Resources;

use App\Handlers\MissingValueHandler;
use App\Handlers\TransformerHistoryHandler;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    use TransformerHistoryHandler, MissingValueHandler;

    public function toArray($request)
    {
        switch ($request->route()->getName()) {
            case 'projects.index' : {
                return [
                    'id' => $this->id,
                    'title' => $this->title
                ];
            }
            case 'projects.history' : {
                $historyLog = $this->log ? json_decode($this->log, true) : [];
                return [
                    'id' => $this->id,
                    'project_id' => $this->hasValue(data_get($historyLog, 'id')),
                    'title' => $this->hasValue(data_get($historyLog, 'title')),
                    'action' => $this->action,
                    'status' => $this->hasValue(data_get($historyLog, 'status')),
                    'priority' => $this->hasValue(data_get($historyLog, 'priority')),
                    'content' => $this->hasValue(data_get($historyLog, 'content')),
                    'file' => $this->hasValue(data_get($historyLog, 'file')),
                    'start_date' => $this->hasValue(data_get($historyLog, 'start_date')),
                    'due_date' => $this->hasValue(data_get($historyLog, 'due_date')),
                    'completed_date' => $this->hasValue(data_get($historyLog, 'completed_date')),
                    'release_date' => $this->hasValue(data_get($historyLog, 'release_date')),
                    'manager' => $this->hasValue(data_get($historyLog, 'manager')),
                    'updated_at' => $this->updated_at->toDateTimeString(),
                    'updated_by' => optional($this->updated_by_user)->account,
                ];
            }
            case 'projects.show' : {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'status' => $this->status,
                    'priority' => $this->priority,
                    'remark' => $this->remark,
                    'start_date' => optional($this->start_date)->toDateTimeString(),
                    'due_date' => optional($this->due_date)->toDateTimeString(),
                    'completed_date' => optional($this->completed_date)->toDateTimeString(),
                    'release_date' => optional($this->release_date)->toDateTimeString(),
                    'updated_by' => optional($this->updated_by_user)->account,
                    'issues' => IssueResource::collection($this->issues),
                    'contents' => ContentResource::collection($this->contents),
                    'files' => FileResource::collection($this->files),
                    'tracker' => optional($this->tracker)->pluck('tracker_name')
                ];
            }
            default : {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'status' => $this->status,
                    'priority' => $this->priority,
                    'remark' => $this->remark,
                    'start_date' => optional($this->start_date)->toDateTimeString(),
                    'due_date' => optional($this->due_date)->toDateTimeString(),
                    'completed_date' => optional($this->completed_date)->toDateTimeString(),
                    'release_date' => optional($this->release_date)->toDateTimeString(),
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
