<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'status', 'priority', 'remark', 'created_date',
        'due_date', 'completed_date', 'release_date', 'created_by',
        'updated_by'
    ];

    const PriorityList = [
        1 => '高', 2 => '正常', 3 => '低'
    ];

    public function getPriorityAttribute($value)
    {
        return self::PriorityList[$value];
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'project_user')
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
