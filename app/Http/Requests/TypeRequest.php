<?php

namespace App\Http\Requests;

class TypeRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->route()->getName()) {
            case 'types.store' :
            case 'types.update' : {
                return [
                    'type_name' => 'required|max:10',
                    'type_info' => 'nullable'
                ];
            }
            default : {
                return [];
            }
        }
    }
}
