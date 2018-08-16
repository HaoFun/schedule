<?php

namespace App\Http\Requests;

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
                    'manager' => 'nullable|integer|exists:users,id'
                ];
            }
            case 'projects.store' : {
                $statuses = implode(',', array_keys(trans('transformer.project_status_list')));
                $priorities = implode(',', array_keys(trans('transformer.priority_list')));
                return [
                    'title' => 'required|max:50',
                    'status' => ['required', 'in:' . $statuses],
                    'priority' => ['required', 'in:' . $priorities],
                    'remark' => 'nullable|max:255',
                    'created_date' => 'required|date',
                    'due_date' => 'required|date',
                    'content' => 'nullable|min:10',
                    'manager' => 'required|array',
                    'manager.*' => 'exists:users,id'
                ];
            }
            case 'projects.update' : {
                $statuses = implode(',', array_keys(trans('transformer.project_status_list')));
                $priorities = implode(',', array_keys(trans('transformer.priority_list')));
                return [
                    'title' => 'nullable|max:50',
                    'status' => ['nullable', 'in:' . $statuses],
                    'priority' => ['nullable', 'in:' . $priorities],
                    'remark' => 'nullable|max:255',
                    'created_date' => 'nullable|date',
                    'due_date' => 'nullable|date',
                    'completed_date' => 'nullable|date',
                    'release_date' => 'nullable|date',
                    'content' => 'nullable|min:10',
                    'manager' => 'nullable|array',
                    'manager.*' => 'exists:users,id'
                ];
            }
            default : {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'manager.*.exists' => trans('validation.manager_exists'),
        ];
    }
}
