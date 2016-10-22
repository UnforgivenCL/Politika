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

Route::get('laws/{id}', ['uses' => 'LawsController@searchByBCN', 'as' => 'search.law.bcn']);

Route::post('laws/search', ['uses' => 'LawsController@search', 'as' => 'search.law']);

// Social Login

Route::get('auth/facebook', ['uses' => 'Auth\RegisterController@redirectToProvider', 'as' => 'login.facebook']);
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
], function () {
    require __DIR__.'/web/admin/admin.php';
});
