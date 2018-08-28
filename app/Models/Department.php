<?php

namespace App\Models;

class Department extends BaseModel
{
    protected $fillable = [
        'department_name', 'department_info'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'department_id')->select('account', 'department_id');
    }
}
