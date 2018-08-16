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
            case 'projects.history' : {
                $historyLog = $this->history_log ? json_decode($this->history_log, true) : [];
                return [
                    'id' => $this->id,
                    'project_id' => $this->historiesable_id,
                    'updated_by' => optional($this->updated_by_user)->account,
                    'action' => data_get($historyLog, 'action', null),
                    'status' => data_get($historyLog, 'status', []),
                    'content' => data_get($historyLog, 'content', []),
                    'created_date' => data_get($historyLog, 'created_date', []),
                    'due_date' => data_get($historyLog, 'due_date', []),
                    'completed_date' => data_get($historyLog, 'completed_date', []),
                    'release_date' => data_get($historyLog, 'release_date', []),
                    'manager' => data_get($historyLog, 'manager', [])
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
