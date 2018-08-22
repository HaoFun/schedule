<?php

namespace App\Observers;

use App\Models\Content;
use App\Observers\Traits\HistoryTrait;
use App\Observers\Traits\MakeRelationDataTrait;

class ContentObserver
{
    use HistoryTrait, MakeRelationDataTrait;

    public function updated(Content $content)
    {
        $this->doAction($content, 'update');
    }

    public function deleted(Content $content)
    {
        $this->doAction($content, 'delete');
    }

    public function doAction(Content $content, $action)
    {
        $result = ['content' => $this->formatMorphActionArray($content->id, $action)];
        if ($historyLog = $this->transformerHistory($action, $content->contentable, $result)) {
            $content->contentable->histories()->create($historyLog);
        }
    }
}
