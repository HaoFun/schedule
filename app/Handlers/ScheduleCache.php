<?php

namespace App\Handlers;

use App\Repositories\AuthorizationRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\TrackerRepository;
use App\Repositories\TypeRepository;
use Illuminate\Support\Facades\Cache;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class ScheduleCache
{
    protected $cacheKey = [
        'user' => 'user_cache',
        'tracker' => 'tracker_cache',
        'department' => 'department_cache',
        'type' => 'type_cache',
    ];

    public function getCacheKey(string $key)
    {
        if (isset($this->cacheKey[$key])) {
            return $this->cacheKey[$key] . '_' . now()->format('md');
        }
        abort(404, trans('exception.cache_attribute_not_found'), $key);
    }

    public function getCacheMethod($key)
    {
        $method = "cache" . ucfirst($key);
        if (!method_exists(get_class(), $method)) {
            throw new MethodNotFoundException('Error', get_class(), $method);
        }
        return $this->$method();
    }

    public function flushCacheKey($key)
    {
        return Cache::forget($this->getCacheKey($key));
    }

    public function getCacheData($key, $time = 1440)
    {
        $cacheKey = $this->getCacheKey($key);
        if ($data = Cache::get($cacheKey)) {
            return unserialize($data);
        }
        return unserialize($this->setCacheData($key, $time));
    }

    public function setCacheData($key, $time)
    {
        return Cache::remember($this->getCacheKey($key), $time, function () use ($key) {
            return $this->getCacheMethod($key);
        });
    }

    public function cacheUser()
    {
        return serialize(app()->make(AuthorizationRepository::class)->all(['id', 'account']));
    }

    public function cacheTracker()
    {
        return serialize(app()->make(TrackerRepository::class)->all(['id', 'tracker_name']));
    }

    public function cacheDepartment()
    {
        return serialize(app()->make(DepartmentRepository::class)->all(['id', 'department_name']));
    }

    public function cacheType()
    {
        return serialize(app()->make(TypeRepository::class)->all(['id', 'type_name']));
    }
}