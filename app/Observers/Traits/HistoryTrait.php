<?php

namespace App\Observers\Traits;

use Illuminate\Database\Eloquent\Model;

trait HistoryTrait
{
    protected $exceptFields = ['created_by', 'updated_by', 'created_at'];

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
                    if (!$this->isExcept($key)) {
                        $historyLog[$key] = $action === 'create' ?
                            [$value] :
                            [$model->getOriginal($key), $value];
                    }
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

    public function isExcept($column)
    {
        return in_array($column, $this->exceptFields);
    }
}