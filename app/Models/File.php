<?php

namespace App\Models;

class File extends BaseModel
{
    protected $fillable = [
        'fileable_id', 'fileable_type', 'file_name', 'file_path',
        'created_by', 'updated_by'
    ];

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by')->select('account');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->select('account');
    }

    public function fileable()
    {
        return $this->morphTo();
    }
}
