<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserPlace extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public function toArray($request)
    {
        $place = $this->place;
        return [
            'place_id' => $place->id,
            'place->place_name' => $place->name_en,
            'image_uri' => $place->image_uri,
            'category_id'=>$place->category_id,
            'city_id' =>$place->city_id,
            'long'=>$place->long,
         //   'lat'=>$place->lat,
            'description'=>$place->description,
            'created_at' => $place->created_at,
            'updated_at' => $place->updated_at,
        ];
    }
}
