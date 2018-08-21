<?php

namespace App\Observers\Traits;

use Illuminate\Database\Eloquent\Model;

trait HistoryTrait
{
    public function transformerHistory($action = 'create', Model $model, $modify = false)
    {
        $historyLog = $this->makeHistoryLog($model, $modify);
        return $historyLog ?
            [
                'action' => $action,
                'log' => json_encode($historyLog),
                'updated_by' => $model->updated_by
            ] :
            false;
    }

    public function makeHistoryLog($model, $modify)
    {
        $historyLog = [];
        $modelDirty = $model->getDirty();
        $morphDirty = $this->getMorphDirty();
        if (count($modelDirty)) {
            foreach ($modelDirty as $key => $value) {
                $historyLog[$key] = [$model->getOriginal($key), $value];
            }
        }
        count($morphDirty) ? $historyLog = array_merge($historyLog, $morphDirty) : null;
        return $historyLog;
    }
}