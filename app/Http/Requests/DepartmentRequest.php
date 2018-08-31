<?php

namespace App\Http\Requests;

use App\Rules\CheckModelUnique;

class DepartmentRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'departments.store' :
            case 'departments.update' : {
                return [
                    'department_name' => ['required', 'max:10',
                        new CheckModelUnique('department', 'department_name')],
                    'department_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
