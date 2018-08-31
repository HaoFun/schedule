<?php

namespace App\Http\Requests;

use App\Rules\CheckPriority;
use App\Rules\CheckStatus;
use App\Rules\CheckTracker;
use App\Rules\CheckType;
use App\Rules\CheckUser;

class IssueRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'issues.search' : {
                return [
                    'title' => 'nullable',
                    'status' => 'nullable',
                    'priority' => 'nullable|integer',
                    'project_name' => 'nullable|string',
                    'type_id' => ['nullable', new CheckType()],
                    'start_date_start' => 'nullable|date|required_with:start_date_end',
                    'start_date_end' => 'nullable|date|required_with:start_date_start|after_or_equal:start_date_start',
                    'due_date_start' => 'nullable|date|required_with:due_date_end',
                    'due_date_end' => 'nullable|date|required_with:due_date_start|after_or_equal:due_date_start',
                    'completed_date_start' => 'nullable|date|required_with:completed_date_end',
                    'completed_date_end' => 'nullable|date|required_with:completed_date_start|after_or_equal:completed_date_start',
                    'release_date_start' => 'nullable|date|required_with:release_date_end',
                    'release_date_end' => 'nullable|date|required_with:release_date_start|after_or_equal:release_date_start',
                    'assignee' => ['nullable', 'integer', new CheckUser('assignee')]
                ];
            }
            case 'issues.store' : {
                return [
                    'title' => 'required|max:50',
                    'project_id' => 'required|exists:projects,id',
                    'status' => ['required', new CheckStatus('issue')],
                    'priority' => ['required', new CheckPriority()],
                    'type_id' => ['required', new CheckType()],
                    'remark' => 'nullable|max:255',
                    'start_date' => 'required|date',
                    'due_date' => 'required|date',
                    'content' => 'nullable|min:10',
                    'assignee' => ['required', 'array', new CheckUser('assignee')],
                    'tracker' => ['required', 'array', new CheckTracker()],
                ];
            }
            case 'issues.update' : {
                return [
                    'title' => 'max:50',
                    'project_id' => 'exists:projects,id',
                    'status' => [new CheckStatus('issue')],
                    'priority' => [new CheckPriority()],
                    'type_id' => [new CheckType()],
                    'remark' => 'max:255',
                    'start_date' => 'date',
                    'due_date' => 'date',
                    'completed_date' => 'date',
                    'release_date' => 'date',
                    'content' => 'nullable|min:10',
                    'assignee' => ['nullable', 'array', new CheckUser('assignee')],
                    'tracker' => ['nullable', 'array', new CheckTracker()],
                ];
            }
            default : {
                return [];
            }
        }
    }
}
