<?php

namespace App\Observers\Traits;

use Illuminate\Database\Eloquent\Model;

trait HistoryTrait
{
    public function transformerHistory($action = 'create', Model $model, $modify = false)
    {
        $historyLog = $this->makeHistoryLog($action, $model, $modify);
        return $historyLog ?
            [
                'action' => $action,
                'log' => json_encode($historyLog),
                'updated_by' => $model->updated_by
            ] :
            false;
    }

    public function makeHistoryLog($action, $model, $modify)
    {
        $historyLog = [];
        try {
            $modelDirty = $model->getDirty();
            $morphDirty = $this->getMorphDirty();
            if (count($modelDirty)) {
                foreach ($modelDirty as $key => $value) {
                    $historyLog[$key] = $action === 'create' ?
                        [$value] :
                        [$model->getOriginal($key), $value];
                }
            }
            count($morphDirty) ?
                $historyLog = array_merge($historyLog, $morphDirty) :
                null;
        } catch (\Exception $e) {

        } finally {
            $historyLog = $modify ?
                array_merge($historyLog, $modify) : $historyLog;
            return $historyLog;
        }
    }
}