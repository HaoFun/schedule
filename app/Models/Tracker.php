<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = [
        'tracker_name', 'tracker_info'
    ];
}
