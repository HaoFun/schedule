<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account', 'name', 'email', 'department_id', 'language', 'password',
        'status', 'api_token', 'password_changed_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    protected $dates = [
        'password_changed_at'
    ];

    public function findForPassport($username)
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['account'] = $username;
        return self::where($credentials)->where('status', 1)->first();
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id')
            ->select('department_name');
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_user')
            ->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withTimestamps();
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
