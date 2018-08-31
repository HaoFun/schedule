<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPriority implements Rule
{
    protected $value;

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        $this->value = $value;
        $priorities = array_keys(trans('transformer.priority_list'));
        return in_array($value, $priorities);
    }

    public function message()
    {
        return sprintf(trans('validation.priority_exists'), $this->value);
    }
}
