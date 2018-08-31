<?php

namespace App\Models;

class Project extends BaseModel
{
    protected $fillable = [
        'title', 'status', 'priority', 'remark', 'start_date',
        'due_date', 'completed_date', 'release_date', 'created_by',
        'updated_by', 'updated_at'
    ];

    protected $dates = [
        'start_date', 'due_date', 'completed_date', 'release_date'
    ];

    public function getPriorityAttribute($value)
    {
        return trans('transformer.priority_list.' . $value);
    }

    public function getStatusAttribute($value)
    {
        return trans('transformer.project_status_list.' . $value);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'project_user')
            ->withTimestamps();
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'project_id');
    }

    public function tracker()
    {
        return $this->belongsToMany(Tracker::class, 'project_tracker')
            ->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function contents()
    {
        return $this->morphMany(Content::class, 'contentable');
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'historiesable');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('id', 'account');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('id', 'account');
    }
}
