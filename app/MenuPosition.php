<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPosition extends Model
{
    public function setIsDefaultAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['is_default'] = $value;
        } else {
            $this->attributes['is_default'] = 0;
        }
    }

    public function setIsActiveAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['is_active'] = $value;
        } else {
            $this->attributes['is_active'] = 0;
        }
    }
}
