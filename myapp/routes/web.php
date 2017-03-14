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

Route::get('/', function () {
    return view('welcome');
});
Route::get('template', function() {
	return view('template');
});
Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');
Route::get('dashboard', 'UserController@dashboard');

//provide help
Route::get('new/donation', 'PhController@create');
Route::post('new/donation/store/', 'PhController@store');


//get help
Route::get('new/request', 'GhController@create');
Route::post('new/request/store', 'GhController@store');
