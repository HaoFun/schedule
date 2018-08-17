<?php

namespace App\Observers;

use App\Models\Issue;
use App\Observers\Traits\HistoryTrait;
use App\Observers\Traits\MakeRelationDataTrait;

class IssueObserver
{
    use HistoryTrait, MakeRelationDataTrait;

    public function created(Issue $issue)
    {
        $this->doAction($issue, 'created');
    }

    public function updated(Issue $issue)
    {
        $this->doAction($issue, 'updated');
    }

    public function deleted(Issue $issue)
    {
        $issue->tracker()->delete();
        $issue->contents()->delete();
        $issue->histories()->delete();
        $issue->files()->delete();
        $issue->user()->delete();
    }

    public function doAction($issue, $type)
    {
        $this->makeContent($issue);
        $this->makeFile($issue);
        $this->makeManager($issue, 'assignee');
        if ($historyLog = $this->transformerHistory($type, $issue)) {
            $issue->histories()->create($historyLog);
        }
    }
}
