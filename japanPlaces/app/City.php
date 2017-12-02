<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name_en'];

    public function places()
    {
        return $this->hasMany('App\Place');
    }
}
