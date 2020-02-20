<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * Get the Area that owns the property.
     */
    public function area()
    {
        return $this->belongsTo('App\BasicUnit','property_area_id','id');
    }
    /**
     * Get the Name that owns the property.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    /***
     * Property Department Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function departments()
    {
        return $this->hasMany('App\PropertyDepartment', 'property_id')->with('Department');
    }
}
