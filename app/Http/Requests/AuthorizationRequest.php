<?php

namespace App\Http\Requests;

class AuthorizationRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'auth.register' : {
                return [
                    'account' => 'required|max:30',
                    'name' => 'required|max:30',
                    'email' => 'required|max:255|email',
                    'department_id' => 'required|exists:departments,id',
                    'language' => 'nullable|max:10',
                    'password' => 'required|max:255'
                ];
            }
            case 'auth.update' : {

            }
            default : {
                return [];
            }
        }
    }
}
