<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function setCreatedByAttribute($value = null)
    {
        $this->isFillable('created_by') ?
            $this->attributes['created_by'] = $value ?? auth()->user()->id :
            null;
    }

    public function setUpdatedByAttribute($value = null)
    {
        $this->isFillable('updated_by') ?
            $this->attributes['updated_by'] = $value ?? auth()->user()->id :
            null;
    }
}