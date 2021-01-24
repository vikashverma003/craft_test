<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// https://datatables.yajrabox.com/starter
// composer require yajra/laravel-datatables-oracle:"~9.0"

Route::get('/', function () {
    return view('welcome');


});

Auth::routes();

// Route::resource('wish','WishListController');
// Route::post('wish/{id}/update', ['as' => 'kit.update', 'uses' => 'WishListController@update']);
//     Route::get('wish/{id}/delete', ['as' => 'kit.delete', 'uses' => 'WishListController@destroy']);

Route::middleware(['auth'])->group(function(){
Route::resource('wish','WishListController');
Route::post('wish/{id}/update', ['as' => 'kit.update', 'uses' => 'WishListController@update']);
Route::get('wish/{id}/delete', ['as' => 'kit.delete', 'uses' => 'WishListController@destroy']);
Route::get('sam',function(){

	echo 34324;
});

});

Route::get('st','UserController@sttt');
Route::get('s_delete','UserController@s_delete');
Route::get('s_all','UserController@s_all');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/home', 'HomeController@index')->name('home');
