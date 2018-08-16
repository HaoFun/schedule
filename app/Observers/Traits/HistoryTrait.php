<?php

namespace App\Observers\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait HistoryTrait
{
    protected $content;
    protected $file;

    public function transformerHistory($action = 'created', Model $model, $modify = false)
    {
        $historyLog = $this->makeHistoryLog($action, $model, $modify);
        return $historyLog ?
            [
                'history_log' => json_encode($historyLog),
                'updated_by' => $model->updated_by
            ] :
            false;
    }

    public function makeHistoryLog($action, $model, $modify)
    {
        switch ($action) {
            case 'created' : {
                return [
                    'action' => $action,
                    'content' => $this->content ?? [],
                    'file' => $this->file ?? [],
                ];
            }
            case 'updated' : {
                return [
                    'action' => $action,
                    'status' => $this->checkEqual($model, 'status'),
                    'priority' => $this->checkEqual($model, 'priority'),
                    'created_date' => $this->checkEqual($model, 'created_date', 'date'),
                    'due_date' => $this->checkEqual($model, 'due_date', 'date'),
                    'completed_date' => $this->checkEqual($model, 'completed_date', 'date'),
                    'release_date' => $this->checkEqual($model, 'release_date', 'date'),
                    'content' => $this->content ?? [],
                    'file' => $this->file ?? [],
                    'manager' => $this->manager ?? [
                            'attached' => [],
                            'detached' => [],
                            'updated' => []
                        ],
                ];
            }
            case 'modify_content' : {
                return [
                    'action' => $action,
                    'content' => optional($modify->id) ? $modify->id : [],
                ];
            }
            case 'modify_file' : {
                return [
                    'action' => $action,
                    'file' => optional($modify->file_name) ? $modify->file_name : []
                ];
            }
            default : {
                return false;
            }
        }
    }

    public function checkEqual($model, $attribute, $type = 'normal')
    {
        switch ($type) {
            case 'date' : {
                $originAttribute = Carbon::parse($model->getOriginal($attribute))->format('Y-m-d');
                $afterAttribute = !is_null(request($attribute, null)) ?
                    Carbon::parse(request($attribute))->format('Y-m-d') :
                    null;
                break;
            }
            case 'normal' :
            default : {
                $originAttribute = $model->getOriginal($attribute);
                $afterAttribute = request($attribute, null);
                break;
            }
        }
        return $originAttribute === $afterAttribute || is_null($afterAttribute) ?
            [$originAttribute, $originAttribute] :
            [$originAttribute, $afterAttribute];
    }
}