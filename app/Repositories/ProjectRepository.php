<?php

namespace App\Repositories;

class ProjectRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Project';
    }

    public function search($perpage, $fields = ['*'])
    {
        return $this->model->select($fields)
            ->with('user:account', 'tracker:tracker_name', 'created_by_user:account', 'updated_by_user:account')
            ->withCount('files', 'contents', 'issues')
            ->when(request('title'), function ($q) {
            return $q->where('title', request('title'). '%');
        })->when(request('status'), function ($q) {
            return $q->where('status', request('status'));
        })->when(request('priority'), function ($q) {
            return $q->where('priority', request('priority'));
        })->when(request('manager'), function ($q) {
            return $q->whereHas('user', function ($q) {
                return $q->whereIn('user_id', request('manager'));
            });
        })->when(request('created_date_start'), function ($q) {
            return $q->whereBetween('created_date', [request('created_date_start'), request('created_date_end')]);
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
        $project = $this->model->with('histories.updated_by_user')
            ->where('id', $id)
            ->first();
        return $project ? $project->histories : $project;
    }
}