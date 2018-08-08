<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'file_id', 'file_type', 'file_name', 'file_path',
        'created_by', 'updated_by'
    ];
}
