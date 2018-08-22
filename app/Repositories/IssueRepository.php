<?php

namespace App\Repositories;

class IssueRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Issue';
    }

    public function search($perpage, $fields = ['*'])
    {
        return $this->model->select($fields)
            ->with('user:account', 'tracker:tracker_name', 'created_by_user:account', 'updated_by_user:account', 'project:title', 'types:type_name')
            ->withCount('files', 'contents')
            ->when(request('title'), function ($q) {
                return $q->where('title', request('title') . '%');
            })->when(request('status'), function ($q) {
                return $q->where('status', request('status'));
            })->when(request('priority'), function ($q) {
                return $q->where('priority', request('priority'));
            })->when(request('project_name'), function ($q) {
                return $q->whereHas('project', function ($q) {
                    return $q->where('title', request('project_name') . '%');
                });
            })->when(request('assignee'), function ($q) {
                return $q->whereHas('user', function ($q) {
                    return $q->whereIn('user_id', request('assignee'));
                });
            })->when(request('type_name'), function ($q) {
                return $q->whereHas('types', function ($q) {
                    return $q->where('type_name', request('type_name'));
                });
            })->when(request('start_date_start'), function ($q) {
                return $q->whereBetween('start_date', [request('start_date_start'), request('start_date_end')]);
            })->when(request('due_date_start'), function ($q) {
                return $q->whereBetween('due_date', [request('due_date_start'), request('due_date_end')]);
            })->when(request('completed_date_start'), function ($q) {
                return $q->whereBetween('completed', [request('completed_date_start'), request('completed_date_end')]);
            })->when(request('release_date_start'), function ($q) {
                return $q->whereBetween('release_date', [request('release_date_start'), request('release_date_end')]);
            })->paginate($perpage);
    }

    public function historyBy($id)
    {
        $issue = $this->model->with('histories.updated_by_user')
            ->where('id', $id)
            ->first();
        return $issue ? $issue->histories : $issue;
    }
}