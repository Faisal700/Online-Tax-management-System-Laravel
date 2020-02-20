<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','citizen_id','id');
    }
}
