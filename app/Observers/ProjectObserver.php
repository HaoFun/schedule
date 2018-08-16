<?php

namespace App\Observers;

use App\Models\Project;
use App\Observers\Traits\HistoryTrait;

class ProjectObserver
{
    use HistoryTrait;

    const contentFields = ['content', 'created_by', 'updated_by'];
    const fileFields = ['file_name', 'file_path', 'created_by', 'updated_by'];

    protected $content;
    protected $file;
    protected $manager;

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
        $this->makeManager($project);
        if ($historyLog = $this->transformerHistory($type, $project)) {
            $project->histories()->create($historyLog);
        }
    }

    public function makeManager($project)
    {
        if (request('manager')) {
            $this->manager = $project->user()->sync(request('manager'));
        }
    }

    public function makeContent($project)
    {
        if (request('content')) {
            $contents = $project->contents()->create(array_only(request()->all(), self::contentFields));
            $this->content = [$contents->id];
        }
    }

    public function makeFile($project)
    {
        if (request('file')) {
            $this->file = $project->files()->createMany([]);
        }
    }
}
