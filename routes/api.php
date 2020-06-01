<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'location' , 'namepace'=>'Location'] , function(){

    Route::post('create' , 'IndexController@create');
    Route::post('update' , 'IndexController@update');
    Route::post('delete' , 'IndexController@delete');
    Route::get('get' , 'IndexController@get');

});


Route::group(['prefix'=> 'tank' , 'namepace'=>'Tank'] , function(){

    Route::post('create' , 'CreateController@create');
    Route::post('update' , 'UpdateController@update');
    Route::post('volume' , 'VolumeController@calculate');
    Route::post('transfer' , 'VolumeController@transfer');
    Route::get('get' , 'UpdateController@get');
});



Route::group(['prefix'=> 'water' , 'namepace'=>'Water'] , function(){
    Route::post('supply' , 'SupplyController@supplyRectangularTank');

});
