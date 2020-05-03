<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function setIsActiveAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['is_active'] = $value;
        } else {
            $this->attributes['is_active'] = 0;
        }
    }
}
