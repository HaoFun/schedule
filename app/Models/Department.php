<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name', 'department_info'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'department_id')->select('account', 'department_id');
    }
}
