<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Place extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'name' => $this->name_en,
        'image_uri' => $this->image_uri,
        'category_id'=>$this->category_id,
        'city_id' =>$this->city_id,
        'long'=>$this->long,
        'lat'=>$this->lat,
        'description'=>$this->description,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
    }
}
