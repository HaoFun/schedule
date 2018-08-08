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
}
