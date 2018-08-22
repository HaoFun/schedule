<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'user_id', 'is_done', 'todo', 'start_date', 'due_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
