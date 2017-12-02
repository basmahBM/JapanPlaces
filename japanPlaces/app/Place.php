<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

	protected $fillable = ['name_en', 'long', 'lat' , 'city_id', 'category_id','description', 'image_uri'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

     public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
