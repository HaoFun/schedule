<?php

namespace App\Models;

class Content extends BaseModel
{
    protected $fillable = [
        'contentable_id', 'contentable_type', 'content',
        'created_by', 'updated_by', 'updated_at'
    ];

    public function contentable()
    {
        return $this->morphTo();
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
