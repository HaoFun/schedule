<?php

namespace App\Models;

class Type extends BaseModel
{
    protected $fillable = [
        'type_name', 'type_info'
    ];

    public function issue()
    {
        return $this->hasOne(Issue::class, 'type_id')->select('id', 'title', 'type_id');
    }
}
