<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyDepartment extends Model
{
    /**
     * Get the department that owns the property.
     */
    public function department()
    {
        return $this->belongsTo('App\Department','department_id','id');
    }
}
