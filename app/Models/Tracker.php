<?php

namespace App\Models;

class Tracker extends BaseModel
{
    protected $fillable = [
        'tracker_name', 'tracker_info'
    ];

    public function issue()
    {
        return $this->belongsToMany(Issue::class, 'issue_tracker');
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'project_tracker');
    }
}
