<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});


Route::group([

    'middleware' => 'api',
  //  'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    //cities API routes
    Route::post('cities', 'CityController@index');
    Route::post('cities/places/{id}', 'CityController@places')->where('id', '[0-9]+');
    Route::post('cities/create', 'CityController@create');
    Route::post('cities/update/{id}', 'CityController@update')->where('id', '[0-9]+');
    Route::post('cities/delete/{id}', 'CityController@delete')->where('id', '[0-9]+');
    Route::post('cities/{id}', 'CityController@show')->where('id', '[0-9]+');

	//places API routes
    Route::post('places', 'PlaceController@index');
    Route::post('places/search', 'PlaceController@search');   
    Route::post('places/create', 'PlaceController@create');
    Route::post('places/update/{id}', 'PlaceController@update')->where('id', '[0-9]+');
    Route::post('places/delete/{id}', 'PlaceController@delete')->where('id', '[0-9]+');
    Route::post('places/{id}', 'PlaceController@show')->where('id', '[0-9]+');

  //User Favorite places
    Route::post('userPlaces', 'UserPlaceController@index');
    Route::post('userPlaces/add', 'UserPlaceController@add');
    Route::post('userPlaces/delete', 'UserPlaceController@delete');


  //images
    Route::get('storage/{dirName}/{filename}', function ($dirName ,$filename)
    {
      return Image::make(storage_path().'/app/public/' .$dirName.'/'.$filename)->response();
    });

  });


  

	




