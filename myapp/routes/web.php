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
    return view('index');
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
Route::get('ph/make/payments', 'PhController@makePayment');
Route::get('ph/cancel/{ph_id}', 'PhController@cancelPH');
Route::get('confirm/ph/payment/{trans_ids}', 'PhController@confirmMatchPayment');
Route::post('confirm/ph/payment/store', 'PhController@storeConfirmMatchPayment');
Route::get('view/attachment/{trans_id}', 'PhController@viewPHAttachment');
// ph/show/transaction

//get help
Route::get('new/request', 'GhController@create');
Route::post('new/request/store', 'GhController@store');
Route::get('confirm/gh/payment', 'GhController@displayReceivedPayment');
Route::get('confirm/gh/payment/edit/{trans_id}', 'GhController@confirmReceivedPayment');
Route::get('view/gh/attachment/{trans_id}', 'GhController@viewGHAttachment');
Route::get('confirm/gh/payment/store/{trans_id}', 'GhController@storeConfirmReceivedPayment');
Route::get('flagpop/{trans_id}', 'GhController@flagAsPop');
Route::get('confirm/gh/payment/history', 'GhController@paymentHistory');

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

Route::get('admin/messaging/compose', 'AdminController@compose');
Route::post('admin/messaging/send/message', 'AdminController@sendMessage');
Route::get('admin/messaging/inbox', 'AdminController@inbox');
Route::get('admin/messaging/outbox', 'AdminController@outbox');
Route::get('admin/messaging/detail/{id}', 'AdminController@showMessage');

Route::get('admin/fakepop', 'AdminController@fakepop');

Route::get('admin/phorders', 'AdminController@viewPhOrders');
Route::get('admin/ghorders', 'AdminController@viewGhOrders');
Route::get('admin/gh/matching', 'AdminController@matchGHRequest');
Route::get('admin/block/donor/delete/{trans_id}', 'AdminController@blockDonorAndDeleteTrans');

//announcements
Route::get('announcements/view', 'AnnouncementController@adminViewAnnouncement');
Route::resource('announcements', 'AnnouncementController');
Route::resource('message', 'MessageController');

Route::resource('referral', 'ReferralController');
//check for registration bonuses and referral bonuses

Route::get('messaging/inbox', 'MessagingController@inbox');
Route::get('messaging/outbox', 'MessagingController@outbox');
Route::get('messaging/compose', 'MessagingController@compose');
