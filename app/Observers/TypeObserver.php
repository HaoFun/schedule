<?php

namespace App\Observers;

use ScheduleCache;
use App\Models\Type;

class TypeObserver
{
    public function creating(Type $type)
    {
        ScheduleCache::flushCacheKey('type');
    }

    public function updating(Type $type)
    {
        ScheduleCache::flushCacheKey('type');
    }

    public function deleting(Type $type)
    {
        ScheduleCache::flushCacheKey('type');
    }
}
