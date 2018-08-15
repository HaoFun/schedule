<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'historiesable_id', 'historiesable_type', 'history_log',
        'updated_by'
    ];

    public function historiesable()
    {
        return $this->morphTo();
    }
}
