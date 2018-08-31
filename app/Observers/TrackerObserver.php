<?php

namespace App\Observers;

use ScheduleCache;
use App\Models\Tracker;

class TrackerObserver
{
    public function creating(Tracker $tracker)
    {
        ScheduleCache::flushCacheKey('tracker');
    }

    public function updating(Tracker $tracker)
    {
        ScheduleCache::flushCacheKey('tracker');
    }

    public function deleting(Tracker $tracker)
    {
        ScheduleCache::flushCacheKey('tracker');
    }
}
