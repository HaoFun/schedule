<?php

namespace App\Handlers;

use App\Models\History;
use App\Models\Issue;
use App\Models\Project;

trait TransformerHistoryHandler
{
    protected $notify_user;

    public function getHistoryMessage(History $history)
    {
        $history->historiesable instanceof Project ?
            $this->setNotifyUserIds($history, 'project') :
            $history->historiesable instanceof  Issue ?
                $this->setNotifyUserIds($history, 'issue') :
                null;
    }

    public function setNotifyUserIds(History $history, $morphModel)
    {
        switch ($morphModel) {
            case 'project' : {
                $this->notify_user = $history->historiesable->user;
            }
            case 'issue' : {
                $this->notify_user = $history->historiesable->user->merge(
                    $history->historiesable->project->user);
            }
            default : {
                $this->notify_user = collect();
                break;
            }
        }
    }
}