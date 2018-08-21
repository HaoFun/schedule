<?php

namespace App\Http\Requests;

class ContentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'content' => 'nullable|min:10'
        ];
    }
}
