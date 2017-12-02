<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Place as PlaceResource;
use Image;
use Illuminate\Support\Facades\File;

class CityController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}


	public function show ($id)
	{
		return response()->json(new CityResource(City::find($id)));
	}

	public function index()
	{
		return response()->json(CityResource::collection(City::all()));
	}

	public function create(Request $request)
	{

		$validatedData = $request->validate([
		'name_en' => 'required|unique:cities|max:255',
		'image_uri' => 'required'
		]);

		$file = $request->image_uri;
		if ($file->isValid()) {
	
			$citiesImagesPath = storage_path().'/app/public/cities/';
			if(!File::exists($citiesImagesPath)) {
				File::makeDirectory($citiesImagesPath, 0775, true, true);
			}
			$fileName = time().'.'.$file->getClientOriginalExtension();		
			$filePath = $citiesImagesPath. $fileName;
			Image::make($file->getRealPath())->resize('250','250')->save($filePath);
		}
		$city = new City;
		$city->name_en= $request->name_en;
		$city->image_uri='cities/'.$fileName;
		$city->save();

		return response()->json(array('error'=>0, 'message'=>'success', 'cityInfo' =>new CityResource($city)));
		}

	
	public function update($id,Request $request)
	{

		$validatedData = $request->validate([
		'name_en' => 'required|unique:cities|max:255',
		]);

		$city = City::find($id);
		$city->name_en= $request->name_en;
		
		if(isset($request->image_uri)){
			$file = $request->image_uri;
			if ($file->isValid()) {
		     	$citiesImagesPath = storage_path().'/app/public/cities/';
				if(!File::exists($citiesImagesPath)) {
					File::makeDirectory($citiesImagesPath, 0775, true, true);
				}
				$fileName = time().'.'.$file->getClientOriginalExtension();		
				$filePath = $citiesImagesPath. $fileName;
				Image::make($file->getRealPath())->resize('250','250')->save($filePath);
			 }
		}
		$city->image_uri='cities/'.$fileName;
		$city->save();

		return response()->json(array('error'=>0, 'message'=>'success', 'cityInfo' =>new CityResource($city)));
		}


	public function delete($id)
	{

		$city = City::find($id);
		if($city){
			
			$city->places()->delete();
			if($city->delete()){
			return response()->json(array('error'=>0, 'message'=>'success'));
			}
				return response()->json(array('error'=>1, 'message'=>'failed to delete'));
		}
		return response()->json(array('error'=>1, 'message'=>'city not found'));

	}

	public function places($id)
	{
		$city = City::find($id);
		if($city){
		 	$places = $city->with('places')->paginate();
		 	return response()->json(['error'=>0, 'message'=>'success',
			 	PlaceResource::collection($places)]);
		}
    	return response()->json(['error'=>1, 'message'=>'city not found']);
			 
	}
	
		
}

