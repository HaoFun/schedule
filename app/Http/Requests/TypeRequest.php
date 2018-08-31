<?php

namespace App\Http\Requests;

use App\Rules\CheckModelUnique;

class TypeRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'types.store' :
            case 'types.update' : {
                return [
                    'type_name' => ['required', 'max:10',
                        new CheckModelUnique('type', 'type_name')],
                    'type_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
