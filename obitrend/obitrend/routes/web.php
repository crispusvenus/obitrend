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

 Route::get('/about', 'LandingController@index')->name('about');
 Route::get('/pricing', 'LandingController@pricing')->name('pricing');
 Route::get('/', 'LandingController@welcome')->name('welcome');

 //  Route::post('/profile/edit/profile',[
 // 'uses' => 'LandingController@register',
 // 'as' => 'regster'
 // ]);
 // Route::post('/show/registration', [
 // 'uses' => 'LandingController@show',
 // 'as' => 'show.reg'
 // ]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/profile/{slug}',[
    'uses' => 'ProfilesController@index',
    'as' => 'profile',
     ]);

     Route::get('/profile/edit/profile',[
    'uses' => 'ProfilesController@edit',
    'as' => 'profile.edit'
    ]);

    Route::post('/profile/update/profile',[
    'uses' => 'ProfilesController@update',
    'as' => 'profile.update'
    ]);

    Route::get('/admin', [
    'uses' => 'AdminController@index',
    'as' => 'admin.index'
    ]);
    Route::get('/admin/view', [
    'uses' => 'AdminController@get_all_requests',
    'as' => 'admin.view.requests'
    ]);
  // fetches the make request view
    Route::get('/announcements/view', [
    'uses' => 'HomeController@index',
    'as' => 'client.index'
    ]);
    Route::get('/announcements/view/myCountry', [
    'uses' => 'HomeController@my_country',
    'as' => 'client.country.view'
    ]);

// sends client request from form data to controller
    Route::post('/announcements/make', [
    'uses' => 'AnnouncementController@create',
    'as' => 'create.announcement'
    ]);

    //updates announcements
    Route::post('/announcements/update/{id}', [
    'uses' => 'AnnouncementController@update',
    'as' => 'update.announcement'
    ]);
    // fetches the request  view
    Route::get('/announcements/make', [
    'uses' => 'AnnouncementController@index',
    'as' => 'client.make'
    ]);
  
    //fetches each announcement
    Route::get('/announcements/show/{id}', [
    'uses' => 'AnnouncementController@announcements',
    'as' => 'client.view.each'
    ]);
    Route::get('/admin/request/{id}', [
    'uses' => 'AdminController@get_request',
    'as' => 'admin.get.request'
    ]);
    //block user
    Route::get('/admin/block/{id}', [
    'uses' => 'AdminController@block',
    'as' => 'admin.block.user'
    ]);
    //approves user request
    Route::get('/admin/approve/{id}', [
    'uses' => 'AdminController@approve_request',
    'as' => 'admin.approve.request'
    ]);
    //decline user request
    Route::get('/admin/decline/{id}', [
    'uses' => 'AdminController@decline_request',
    'as' => 'admin.decline.request'
    ]);
    //gets each request as selected by the user
    Route::get('announcement/each/{id}', [
    'uses' => 'AnnouncementController@get_each_announcements',
    'as' => 'client.each.announcement'
    ]);
    //posts tributes
    Route::post('/tributes/create', [
    'uses' => 'AnnouncementController@create_comment',
    'as' => 'create.comment'
    ]);
    //posts comment
    Route::post('/comments/create', [
    'uses' => 'AnnouncementController@create_comments',
    'as' => 'create.comments'
    ]);
    Route::get('admin/pdf','AnnouncementController@download');

    //routes to extract images from storage
    Route::get('storage/upload/{id}','AnnouncementController@upload');
    Route::get('storage/id/{id}','AnnouncementController@id');
    Route::get('storage/defaults/avatars/{id}','AnnouncementController@avatar');

});
