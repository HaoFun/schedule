<?php

namespace App\Observers;

use App\Models\Project;
use App\Observers\Traits\HistoryTrait;
use App\Observers\Traits\MakeRelationDataTrait;

class ProjectObserver
{
    use HistoryTrait, MakeRelationDataTrait;

    public function created(Project $project)
    {
        $this->doAction($project, 'created');
    }

    public function updated(Project $project)
    {
        $this->doAction($project, 'updated');
    }

    public function deleted(Project $project)
    {
        $project->issues()->delete();
        $project->tracker()->delete();
        $project->contents()->delete();
        $project->histories()->delete();
        $project->files()->delete();
        $project->user()->delete();
    }

    public function doAction($project, $type)
    {
        $this->makeContent($project);
        $this->makeFile($project);
        $this->makeManager($project, 'manager');
        if ($historyLog = $this->transformerHistory($type, $project)) {
            $project->histories()->create($historyLog);
        }
    }
}
