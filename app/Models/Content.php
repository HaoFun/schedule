<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'content_id', 'content_type', 'content', 'created_by',
        'updated_by'
    ];
}
