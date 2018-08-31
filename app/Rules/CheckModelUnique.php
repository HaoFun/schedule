<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ScheduleCache;

class CheckModelUnique implements Rule
{
    protected $value, $model, $attribute;

    public function __construct($model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function passes($attribute, $value)
    {
        if ($trackers = ScheduleCache::getCacheData($this->model)) {
            $this->value = $value;
            return !in_array($value, $trackers->pluck($this->attribute)->toArray());
        }
        return false;
    }

    public function message()
    {
        return sprintf(trans('validation.' . $this->attribute . '_unique'), $this->value);
    }
}
