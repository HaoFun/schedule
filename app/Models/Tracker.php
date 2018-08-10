<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
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
