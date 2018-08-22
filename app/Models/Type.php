<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'type_name', 'type_info'
    ];

    public function issue()
    {
        return $this->hasOne(Issue::class, 'type_id')->select('id', 'title', 'type_id');
    }
}
