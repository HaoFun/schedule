<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckStatus implements Rule
{
    protected $type;
    protected $value;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function passes($attribute, $value)
    {
        $this->value = $value;
        $statuses = array_keys(trans('transformer.' . $this->type . '_status_list'));
        return in_array($value, $statuses);
    }

    public function message()
    {
        return sprintf(trans('validation.status_exists'), $this->value);
    }
}
