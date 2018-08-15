<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    static public $status = [1,2,3,4];
    static public $priority = [1,2,3];
    protected $fillable = [
        'project_id', 'title', 'status', 'priority', 'remark',
        'created_date', 'due_date', 'completed_date', 'release_date',
        'created_by', 'updated_by'
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
