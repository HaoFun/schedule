<?php

namespace App\Observers;

use ScheduleCache;
use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->api_token = str_random(64);
        ScheduleCache::flushCacheKey('user');
    }

    public function updating(User $user)
    {
        ScheduleCache::flushCacheKey('user');
    }

    public function deleting(User $user)
    {
        ScheduleCache::flushCacheKey('user');
    }
}
