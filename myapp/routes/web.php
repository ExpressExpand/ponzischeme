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
Route::get('change/password', 'ProfileController@changePassword');
Route::patch('change/password/store/{user_id}', 'ProfileController@storeChangedPassword');
Route::put('profile/change/picture', 'ProfileController@changePicture');
Route::get('verify/email', 'ProfileController@verifyEmail');
Route::get('verified/email/{hash}', 'ProfileController@verifiedEmail');
//admin
Route::get('users', 'AdminController@viewUsers');
Route::get('admin/block/user/{user_id}', 'AdminController@blockUser');
Route::get('admin/unblock/user/{user_id}', 'AdminController@unblockUser');
Route::get('admin/user/profile/{user_id}', 'AdminController@viewUserProfile');
Route::patch('admin/change/password/store/{user_id}', 'AdminController@storeChangedUserPassword');
Route::post('admin/change/role', 'AdminController@changeRoles');

Route::get('admin/phorders', 'AdminController@viewPhOrders');
Route::get('admin/ghorders', 'AdminController@viewGhOrders');
Route::get('admin/gh/matching', 'AdminController@matchGHRequest');

//announcements
Route::resource('announcements', 'AnnouncementController');
Route::resource('message', 'MessageController');

//check for registration bonuses and referral bonuses
