<?php

namespace App\Handlers;

use Illuminate\Http\Resources\MissingValue;

trait MissingValueHandler
{
    protected function hasValue($condition, $default = null)
    {
        if ($condition) {
            return value($condition);
        }
        return func_num_args() === 2 ? value($default) : new MissingValue();
    }
}