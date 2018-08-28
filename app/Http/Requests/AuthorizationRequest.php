<?php

namespace App\Http\Requests;

class AuthorizationRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'auth.register' : {
                return [
                    'account' => 'required|max:30|unique:users,account',
                    'name' => 'required|max:30',
                    'email' => 'required|max:255|email|unique:users,email',
                    'department_id' => 'required|exists:departments,id',
                    'language' => 'nullable|max:10',
                    'password' => 'required|max:255'
                ];
            }
            case 'auth.update' : {
                return [
                    'account' => 'max:30|unique:users,account,' . auth()->user()->id,
                    'name' => 'max:30',
                    'email' => 'max:255|email|unique:users,email,' . auth()->user()->email,
                    'department_id' => 'exists:departments,id',
                    'language' => 'max:10',
                    'password' => 'max:255'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
