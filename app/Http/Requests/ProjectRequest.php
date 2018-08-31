<?php

namespace App\Http\Requests;

use App\Rules\CheckPriority;
use App\Rules\CheckStatus;
use App\Rules\CheckTracker;
use App\Rules\CheckUser;

class ProjectRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'projects.search' : {
                return [
                    'title' => 'nullable',
                    'status' => 'nullable',
                    'priority' => 'nullable|integer',
                    'start_date_start' => 'nullable|date|required_with:start_date_end',
                    'start_date_end' => 'nullable|date|required_with:start_date_start|after_or_equal:start_date_start',
                    'due_date_start' => 'nullable|date|required_with:due_date_end',
                    'due_date_end' => 'nullable|date|required_with:due_date_start|after_or_equal:due_date_start',
                    'completed_date_start' => 'nullable|date|required_with:completed_date_end',
                    'completed_date_end' => 'nullable|date|required_with:completed_date_start|after_or_equal:completed_date_start',
                    'release_date_start' => 'nullable|date|required_with:release_date_end',
                    'release_date_end' => 'nullable|date|required_with:release_date_start|after_or_equal:release_date_start',
                    'manager' => ['nullable', 'integer', new CheckUser('manager')]
                ];
            }
            case 'projects.store' : {
                return [
                    'title' => 'required|max:50',
                    'status' => ['required', new CheckStatus('project')],
                    'priority' => ['required', new CheckPriority()],
                    'remark' => 'nullable|max:255',
                    'start_date' => 'required|date',
                    'due_date' => 'required|date',
                    'content' => 'nullable|min:10',
                    'manager' => ['required', 'array', new CheckUser('manager')],
                    'tracker' => ['required', 'array', new CheckTracker()],
                ];
            }
            case 'projects.update' : {
                return [
                    'title' => 'nullable|max:50',
                    'status' => ['nullable', new CheckStatus('project')],
                    'priority' => ['nullable', new CheckPriority()],
                    'remark' => 'nullable|max:255',
                    'start_date' => 'nullable|date',
                    'due_date' => 'nullable|date',
                    'completed_date' => 'nullable|date',
                    'release_date' => 'nullable|date',
                    'content' => 'nullable|min:10',
                    'manager' => ['nullable', 'array', new CheckUser('manager')],
                    'tracker' => ['nullable', 'array', new CheckTracker()],
                ];
            }
            default : {
                return [];
            }
        }
    }
}
