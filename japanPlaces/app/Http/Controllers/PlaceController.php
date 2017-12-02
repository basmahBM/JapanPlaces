<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Http\Resources\Place as PlaceResource;
use Image;
use Illuminate\Support\Facades\File;


class PlaceController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:api');
	}


	public function show ($id)
	{
		$place = Place::find($id);
		if($place){
		return response()->json([ 
			'error'=>0 ,
			'message'=>"success" ,
			'placeInfo' => $place,
		]);
		}
		return response()->json([ 
				'error'=>1,
				'message'=>"Place not found" 
			]);
	}

	public function index()
	{
		return response()->json(['error'=>0, 'message'=>'success' ,Place::paginate()]);
	}

	public function create(Request $request)
	{
		$validatedData = $request->validate([
			'name_en' => 'required|unique:places|max:255',
			'image_uri' => 'required',
			'long' => 'required', 
			'lat' => 'required', 
			'city_id' => 'required',
			'category_id' => 'required',
			'description' => 'required',
		]);

		$file = $request->image_uri;
		if ($file->isValid()) {
			$placesImagesPath = storage_path().'/app/public/places/';
			if(!File::exists($placesImagesPath)) {
				File::makeDirectory($placesImagesPath, 0775, true, true);
			}
			$fileName = time().'.'.$file->getClientOriginalExtension();		
			$filePath = $placesImagesPath. $fileName;
			Image::make($file->getRealPath())->resize('250','250')->save($filePath);
		}

		$place = Place::firstOrCreate([
			'name_en' => $request->name_en,
			'image_uri' => 'places/'.$fileName,
			'long' => $request->long, 
			'lat' => $request->lat, 
			'city_id' => $request->city_id,
			'category_id' => $request->category_id,
			'description' => $request->description,
		]);
		
		return response()->json(array('error'=>0, 'message'=>'success', 'placeInfo' =>new PlaceResource($place)));
		}

	
	public function update($id,Request $request)
	{

		$validatedData = $request->validate([
		'name_en' => 'required|unique:places|max:255',
		'long' => 'required', 
		'lat' => 'required', 
		'city_id' => 'required',
		'category_id' => 'required',
		'description' => 'required',
		]);

		$place = Place::find($id);
		$place->name_en = $request->name_en;
		$place->long = $request->long;
		$place->lat = $request->lat;
		$place->city_id = $request->city_id;
		$place->category_id = $request->category_id;
		$place->description = $request->description;

		if(isset($request->image_uri)){
			$file = $request->image_uri;
			if ($file->isValid()) {
				$placesImagesPath = storage_path().'/app/public/places/';
				if(!File::exists($placesImagesPath)) {
					File::makeDirectory($placesImagesPath, 0775, true, true);
				}
				$fileName = time().'.'.$file->getClientOriginalExtension();		
				$filePath = $placesImagesPath. $fileName;
				Image::make($file->getRealPath())->resize('250','250')->save($filePath);
			}
		}
		$place->image_uri='places/'.$fileName;
		$place->save();

		return response()->json(array('error'=>0, 'message'=>'success', 'placeInfo' =>new PlaceResource($place)));
		}


	public function delete($id)
	{
		$place = Place::find($id);
		if($place){
			
			if($place->delete()){
			return response()->json(array('error'=>0, 'message'=>'success'));
			}
				return response()->json(array('error'=>1, 'message'=>'failed to delete'));
		}
		return response()->json(array('error'=>1, 'message'=>'place not found'));

	}


	public function search(Request $request)
	{

		$validatedData = $request->validate([
			'keyword' => 'required',
		]);

		$places= Place::where('name_en', 'like', '%' . $request->keyword. '%')->get();

		if( count($places) > 0 ) {
			return response()->json(['error'=>0, 'message'=>'success' ,'places'=>$places]);
		}
		return response()->json(['error'=>1, 'message'=>'No results found']);

	}

}
