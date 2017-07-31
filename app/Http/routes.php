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
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

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

/*
|--------------------------------------------------------------------------
| Message Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/addNewMessage', 'MessagesController@addNewMessage');
