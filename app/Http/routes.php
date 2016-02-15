<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('home');
    });


    Route::get('twitter/login', 'HomeController@login')->name('twitter.login');
    Route::get('twitter/callback', 'HomeController@callback')->name('twitter.callback');
    Route::get('twitter/error', 'HomeController@error')->name('twitter.error');
    Route::get('twitter/logout', 'HomeController@logout')->name('twitter.logout');
    Route::get('/tweet', 'HomeController@tweet');

});
