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

Route::get('/', function () {

    if (\Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }

});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    /*
    |--------------------------------------------------------------------------
    | Room Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::post('/addNewRoom', 'RoomsController@addNewRoom');
    Route::get('/getAllRooms', 'RoomsController@getAllRooms');
    Route::get('/myRooms', 'RoomsController@myRooms');
    Route::get('/deleteMyRoom/{id}', 'RoomsController@deleteMyRoom');
    Route::get('/getMeOnline/{room_id}', 'RoomsController@getMeOnline');
    Route::get('/getMeLeaving/{room_id}', 'RoomsController@getMeLeaving');

    /*
    |--------------------------------------------------------------------------
    | Message Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::post('/addNewMessage', 'MessagesController@addNewMessage');
    Route::get('/getAuthUser', 'MessagesController@getAuthUser');

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::post('/uploadAvatar', 'UserController@uploadAvatar');
    Route::get('/getAuthUserAvatar', 'UserController@getAuthUserAvatar');

});
