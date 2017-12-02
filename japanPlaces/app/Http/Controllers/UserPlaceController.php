<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlace;
use App\Http\Resources\UserPlace as UserPlaceResource;
use Illuminate\Support\Facades\Auth;



class UserPlaceController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth:api');
	}


	public function index()
	{
		$user= Auth::user(); 
		$places = $user->places;
	
		return response()->json(['error'=>0, 'message'=>'success' ,
			UserPlaceResource::collection($places)]);
	}

	public function add(Request $request)
	{
		$validatedData = $request->validate([
			'place_id' => 'required',
		]);
		$userId = Auth::user()->id;
	    $userPlace = new UserPlace;
	    $userPlace->user_id = $userId;
	    $userPlace->place_id = $request->place_id;

	    if( $userPlace->save()) {

		return response()->json(array('error'=>0, 'message'=>'success'));
	}else{
		return response()->json(array('error'=>0, 'message'=>'failed to save'));
		}
	}
	

	public function delete(Request $request)
	{
		$validatedData = $request->validate([
			'place_id' => 'required',
		]);
		
		$userId = Auth::user()->id;
		$userPlace = UserPlace::find(['place_id' => $request->place_id, 'user_id' => $userId]);

		if($userPlace){
			
			if($userPlace->delete()){
			return response()->json(array('error'=>0, 'message'=>'success'));
			}
				return response()->json(array('error'=>1, 'message'=>'failed to delete'));
		}
		return response()->json(array('error'=>1, 'message'=>'place not found'));

	}


}
