<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlace extends Model
{
     public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

     public function place()
    {
        return $this->belongsTo('App\Place', 'place_id');
    }
}
