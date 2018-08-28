<?php

namespace App\Models;

class Issue extends BaseModel
{
    protected $fillable = [
        'project_id', 'title', 'status', 'priority', 'remark', 'type_id',
        'start_date', 'due_date', 'completed_date', 'release_date',
        'created_by', 'updated_by', 'updated_at'
    ];

    protected $dates = [
        'start_date', 'due_date', 'completed_date', 'release_date'
    ];

    public function getStatusAttribute($value)
    {
        return trans('transformer.issue_status_list.' . $value);
    }

    public function getPriorityAttribute($value)
    {
        return trans('transformer.priority_list.' . $value);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'issue_user')
            ->withTimestamps();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tracker()
    {
        return $this->belongsToMany(Tracker::class, 'issue_tracker')
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

    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id')->select('type_name');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->select('account');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('account');
    }
}
