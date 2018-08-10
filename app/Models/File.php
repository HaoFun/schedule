<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'fileable_id', 'fileable_type', 'file_name', 'file_path',
        'created_by', 'updated_by'
    ];

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function fileable()
    {
        return $this->morphTo();
    }
}
