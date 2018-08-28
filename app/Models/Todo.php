<?php

namespace App\Models;

class Todo extends BaseModel
{
    protected $fillable = [
        'user_id', 'is_done', 'todo', 'start_date', 'due_date'
    ];

    protected $dates = [
        'start_date', 'due_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
