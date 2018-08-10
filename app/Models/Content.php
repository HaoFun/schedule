<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'contentable_id', 'contentable_type', 'content_body', 'remark',
        'created_by', 'updated_by'
    ];

    public function contentable()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
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
