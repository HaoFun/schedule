<?php

namespace App\Rules;

use ScheduleCache;
use Illuminate\Contracts\Validation\Rule;

class CheckUser implements Rule
{
    protected $owner;
    protected $failed = [];

    public function __construct($owner)
    {
        $this->owner = $owner;
    }

    public function passes($attribute, $value)
    {
        if ($user = ScheduleCache::getCacheData('user')) {
            $this->failed = array_diff(is_array($value) ? $value : [$value],
                $user->pluck('id')->toArray());
            return $this->failed ? false : true;
        }
        return false;
    }

    public function message()
    {
        return sprintf(trans('validation.' . $this->owner . '_exists'),
            implode(', ', $this->failed));
    }
}
