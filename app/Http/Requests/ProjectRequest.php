<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Validation\Rule;

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
                    'created_date_start' => 'nullable|date|required_with:created_date_end',
                    'created_date_end' => 'nullable|date|required_with:created_date_start|after_or_equal:created_date_start',
                    'due_date_start' => 'nullable|date|required_with:due_date_end',
                    'due_date_end' => 'nullable|date|required_with:due_date_start|after_or_equal:due_date_start',
                    'completed_date_start' => 'nullable|date|required_with:completed_date_end',
                    'completed_date_end' => 'nullable|date|required_with:completed_date_start|after_or_equal:completed_date_start',
                    'release_date_start' => 'nullable|date|required_with:release_date_end',
                    'release_date_end' => 'nullable|date|required_with:release_date_start|after_or_equal:release_date_start',
                    'user_id' => 'nullable|integer|exists:users,id'
                ];
            }
            case 'projects.store' : {
                return [
                    'title' => 'required|max:50',
                    'status' => ['required', Rule::in(Project::$status)],
                    'priority' => ['required', Rule::in(Project::$priority)],
                    'remark' => 'nullable|max:255',
                    'created_date' => 'required|date',
                    'due_date' => 'required|date',
                    'content' => 'nullable|min:10',
                ];
            }
            default : {
                return [];
            }
        }
    }
}
