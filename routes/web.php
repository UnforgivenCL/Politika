<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'index']);

Auth::routes();

Route::get('home', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::post('laws/search', ['uses' => 'WelcomeController@search', 'as' => 'search.law']);

// Social Login

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');
