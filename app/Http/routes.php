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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index'] );

Route::get('inspiration', 'InspirationsController@index');

Route::get('following', 'FollowingsController@index');
Route::post('follow', ['as' => 'follow', 'uses' => 'FollowingsController@followUser']);
Route::post('unfollow', ['as' => 'unfollow', 'uses' => 'FollowingsController@unFollowUser']);

Route::post('follow', ['as' => 'movies.add', 'uses' => 'MoviesController@addMovieToUser']);
Route::post('unfollow', ['as' => 'movies.remove', 'uses' => 'MoviesController@removeMovieFromUser']);

Route::post('search', ['as' => 'movies.search', 'uses' => 'MoviesController@movieSearch' ]);

Route::resource('users', 'UsersController');
Route::resource('movies', 'MoviesController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

