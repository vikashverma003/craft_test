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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('check', 'API\UserController@check');


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'API\UserController@details');

Route::post('change_password', 'API\UserController@changePassword');
Route::post('edit_profile', 'API\UserController@editProfile');
Route::post('logout', 'API\UserController@logout');

   Route::middleware('user_auth')->group(function(){

   	Route::post('change_mid_data', 'API\UserController@change_mid_data');


   });


});

Route::get('random_password', 'API\UserController@randomPasswordGenerator');
Route::post('forgot_password', 'API\UserController@forgotPassword');


