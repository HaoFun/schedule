<?php

namespace App\Rules;

use ScheduleCache;
use Illuminate\Contracts\Validation\Rule;

class CheckTracker implements Rule
{
    protected $failed;

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        if ($trackers = ScheduleCache::getCacheData('tracker')) {
            $this->failed = array_diff(is_array($value) ? $value : [$value],
                $trackers->pluck('id')->toArray());
            return $this->failed ? false : true;
        }
        return false;
    }

    public function message()
    {
        return sprintf(trans('validation.tracker_exists'), implode(', ', $this->failed));
    }
}
