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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('items', 'ItemController@getItems');
Route::post('items/create', 'ItemController@create');
Route::put('items/edit', 'ItemController@edit');
Route::delete('items/delete/{id}', 'ItemController@delete');

Route::post('rfid/postTimeOut', 'RfidController@postTimeOut');
Route::get('rfid/getPerson', 'RfidController@getPerson');
Route::get('rfid/getPrevPerson', 'RfidController@getPrevPerson');
Route::get('rfid/getThirdPerson', 'RfidController@getThirdPerson');




