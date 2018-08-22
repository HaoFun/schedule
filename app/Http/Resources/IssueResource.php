<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($request->route()->getName()) {
            case 'issues.index' : {
                return [
                    'title' => $this->title
                ];
            }
            case 'issues.history' : {
                $historyLog = $this->history_log ? json_decode($this->history_log, true) : [];
                return [
                    'id' => $this->id,
                    'project_id' => $this->historiesable_id,
                    'updated_by' => optional($this->updated_by_user)->account,
                    'action' => data_get($historyLog, 'action', null),
                    'status' => data_get($historyLog, 'status', []),
                    'content' => data_get($historyLog, 'content', []),
                    'start_date' => data_get($historyLog, 'start_date', []),
                    'due_date' => data_get($historyLog, 'due_date', []),
                    'completed_date' => data_get($historyLog, 'completed_date', []),
                    'release_date' => data_get($historyLog, 'release_date', []),
                    'assignee' => data_get($historyLog, 'assignee', [])
                ];
            }
            default : {
                return [
                    'id' => $this->id,
                    'title' => $this->title,
                    'status' => $this->status,
                    'priority' => $this->priority,
                    'remark' => $this->remark,
                    'start_date' => $this->start_date,
                    'due_date' => $this->due_date,
                    'completed_date' => $this->completed_date,
                    'release_date' => $this->release_date,
                    'files_count' => $this->files_count,
                    'contents_count' => $this->contents_count,
                    'issues_count' => $this->issues_count,
                    'assignee' => $this->user->pluck('account'),
                    'tracker' => $this->tracker->pluck('tracker_name'),
                    'created_by' => optional($this->created_by_user)->account,
                    'updated_by' => optional($this->updated_by_user)->account
                ];
            }
        }
    }
}
