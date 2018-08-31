<?php

namespace App\Rules;

use ScheduleCache;
use Illuminate\Contracts\Validation\Rule;

class CheckType implements Rule
{
    protected $value;

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        if ($types = ScheduleCache::getCacheData('type')) {
            $this->value = $value;
            return in_array($value, $types->pluck('id')->toArray());
        }
        return false;
    }

    public function message()
    {
        return sprintf(trans('validation.type_exists'), $this->value);
    }
}
