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

Route::post('search', array('as' => 'movies.search', 'uses' => 'MoviesController@postMovieSearch' ));

Route::post('search-title', array('as' => 'movies.search-title', 'uses' => 'MoviesController@postMovieTitleSearch' ));

Route::resource('users', 'UsersController');
Route::resource('movies', 'MoviesController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

