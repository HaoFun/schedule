<?php

namespace App\Observers;

use App\Models\Issue;
use App\Observers\Traits\HistoryTrait;
use App\Observers\Traits\MakeRelationDataTrait;

class IssueObserver
{
    use HistoryTrait, MakeRelationDataTrait;

    public function creating(Issue $issue)
    {
        if (!$issue->start_date) {
            $issue->start_date = now();
        }
    }

    public function created(Issue $issue)
    {
        $this->doAction($issue, 'create');
    }

    public function updating(Issue $issue)
    {
        if ($issue->status === trans('transformer.issue_status_list')[
            config('schedule_config.issue_finished')]) {
            $issue->release_date = now();
        }
    }

    public function updated(Issue $issue)
    {
        $this->doAction($issue, 'update');
    }

    public function deleted(Issue $issue)
    {
        $issue->tracker()->detach();
        $issue->contents()->delete();
        $issue->histories()->delete();
        $issue->files()->delete();
        $issue->user()->detach();
    }

    public function doAction($issue, $type)
    {
        $this->makeContent($issue);
        $this->makeFile($issue);
        $this->makeOwner($issue, 'assignee');
        $this->makeTracker($issue);
        if ($historyLog = $this->transformerHistory($type, $issue)) {
            $issue->histories()->create($historyLog);
        }
    }
}
