<?php

namespace App\Repositories;

class TodoRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Todo';
    }

    public function search($perpage = 20)
    {
        $query = $this->model->when(request('is_done'), function ($q) {
            return $q->where('is_done', request('is_done'));
        })->when(request('start_date'), function ($q) {
            return $q->whereDate('start_date', request('start_date'));
        })->when(request('due_date'), function ($q) {
            return $q->whereDate('due_date', request('due_date'));
        })->orderBy('created_at', 'asc');
        return request('with') === 'paginate' ?
            $query->paginate($perpage)->setPath(route('todos.search'))->appends(request()->except('page')) :
            $query->get();
    }
}
