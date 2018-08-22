<?php

namespace App\Http\Requests;

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
                    'type_name' => 'nullable|exists:types,type_name',
                    'start_date_start' => 'nullable|date|required_with:start_date_end',
                    'start_date_end' => 'nullable|date|required_with:start_date_start|after_or_equal:start_date_start',
                    'due_date_start' => 'nullable|date|required_with:due_date_end',
                    'due_date_end' => 'nullable|date|required_with:due_date_start|after_or_equal:due_date_start',
                    'completed_date_start' => 'nullable|date|required_with:completed_date_end',
                    'completed_date_end' => 'nullable|date|required_with:completed_date_start|after_or_equal:completed_date_start',
                    'release_date_start' => 'nullable|date|required_with:release_date_end',
                    'release_date_end' => 'nullable|date|required_with:release_date_start|after_or_equal:release_date_start',
                    'assignee' => 'nullable|integer|exists:users,id'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
