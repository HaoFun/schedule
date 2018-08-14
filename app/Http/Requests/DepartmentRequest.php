<?php

namespace App\Http\Requests;

class DepartmentRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'departments.store' :
            case 'departments.update' : {
                return [
                    'department_name' => 'required|max:10',
                    'department_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
