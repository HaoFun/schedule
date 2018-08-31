<?php

namespace App\Rules;

use ScheduleCache;
use Illuminate\Contracts\Validation\Rule;

class CheckDepartment implements Rule
{
    protected $value;

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        if ($departments = ScheduleCache::getCacheKey('department')) {
            $this->value = $value;
            return in_array($value, $departments->pluck('id')->toArray());
        }
        return false;
    }

    public function message()
    {
        return sprintf(trans('validation.department_exists'), $this->value);
    }
}
