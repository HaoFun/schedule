<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'contentable_id', 'contentable_type', 'content',
        'created_by', 'updated_by'
    ];

    public function contentable()
    {
        return $this->morphTo();
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'historiesable');
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
