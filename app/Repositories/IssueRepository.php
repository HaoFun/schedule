<?php

namespace App\Repositories;

class IssueRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Project';
    }

    public function historyBy($id)
    {
        $issue = $this->model->with('histories.updated_by_user')
            ->where('id', $id)
            ->first();
        return $issue ? $issue->histories : $issue;
    }
}