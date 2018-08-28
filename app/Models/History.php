<?php

namespace App\Models;

class History extends BaseModel
{
    protected $fillable = [
        'historiesable_id', 'historiesable_type', 'log', 'action',
        'updated_by'
    ];

    public function historiesable()
    {
        return $this->morphTo();
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('id', 'account');
    }
}
