<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'GuestController@index');
Route::post('/store/find','GuestController@searchIndex');
Route::get('/store', 'GuestController@storeIndex');
Route::get('/store/genre/{genre}/{id}','GuestController@storeGenre');
Route::post('/guest/login','GuestController@login');

Route::group(['middleware' => 'auth'],function(){
	Route::resource('/users','ProfileController');
	Route::resource('/cart','CartController');
	Route::resource('/rate','RateController');
	Route::get('/mygames','CartController@myGames');
	Route::get('/product/{id}','HomeController@viewProduct');
	Route::group(['middleware' => 'admin','prefix'=>'admin'],function(){
		route::resource('/genre','GenreController');
		route::resource('/user','UserController');
		route::resource('/games','GameController');
		route::resource('/transaction','TransactionHistoryController');
	});
});

Route::auth();

Route::get('/home', 'HomeController@index');
