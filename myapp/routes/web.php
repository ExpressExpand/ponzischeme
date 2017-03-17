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
Route::get('all/ph/payments', 'PhController@allPayments');
Route::get('ph/transactions', 'PhController@transactions');


//get help
Route::get('new/request', 'GhController@create');
Route::post('new/request/store', 'GhController@store');

//profile
Route::get('profile', 'ProfileController@viewProfile');
Route::put('profile/store', 'ProfileController@storeProfile');
Route::put('profile/change/username', 'ProfileController@changeUsername');
Route::put('change/password', 'ProfileController@changePassword');
Route::put('profile/change/picture', 'ProfileController@changePicture');
Route::get('verify/email', 'ProfileController@verifyEmail');
Route::get('verified/email/{hash}', 'ProfileController@verifiedEmail');
//admin
Route::get('users', 'AdminController@viewUsers');

//check for registration bonuses and referral bonuses

#profile-image1 {
 //    cursor: pointer;
  
 //     width: 100px;
 //    height: 100px;
	// border:2px solid #03b1ce ;}
	// .tital{ font-size:16px; font-weight:500;}
	//  .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}