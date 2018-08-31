<?php

namespace App\Observers;

use ScheduleCache;
use App\Models\Department;

class DepartmentObserver
{
    public function creating(Department $department)
    {
        ScheduleCache::flushCacheKey('department');
    }

    public function updating(Department $department)
    {
        ScheduleCache::flushCacheKey('department');
    }

    public function deleting(Department $department)
    {
        ScheduleCache::flushCacheKey('department');
    }
}
