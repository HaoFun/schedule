<?php

namespace App\Observers;

use App\Models\Project;
use App\Observers\Traits\HistoryTrait;
use App\Observers\Traits\MakeRelationDataTrait;

class ProjectObserver
{
    use HistoryTrait, MakeRelationDataTrait;

    public function creating(Project $project)
    {
        if (!$project->start_date) {
            $project->start_date = now();
        }
    }

    public function created(Project $project)
    {
        $this->doAction($project, 'create');
    }

    public function updating(Project $project)
    {
        if ($project->status === trans('transformer.project_status_list')[
            config('schedule_config.project_finished')]) {
            $project->release_date = now();
        }
    }

    public function updated(Project $project)
    {
        $this->doAction($project, 'update');
    }

    public function deleted(Project $project)
    {
        $project->issues()->delete();
        $project->tracker()->detach();
        $project->contents()->delete();
        $project->histories()->delete();
        $project->files()->delete();
        $project->user()->detach();
    }

    public function doAction($project, $type)
    {
        $this->makeContent($project);
        $this->makeFile($project);
        $this->makeOwner($project, 'manager');
        $this->makeTracker($project);
        if ($historyLog = $this->transformerHistory($type, $project)) {
            $project->histories()->create($historyLog);
        }
    }
}
