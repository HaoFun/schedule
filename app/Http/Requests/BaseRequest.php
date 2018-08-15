<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Handlers\ResponseHandler;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    use ResponseHandler;

    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        if ($this->isJson()) {
            throw new HttpResponseException(
                $this->errorWith($validator->errors()->messages(),
                    trans('common.validation_error'),
                    422));
        }
        parent::failedValidation($validator);
    }
}