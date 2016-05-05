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

//----------------------------------------------------//
//------------------App user Routes------------------//
//--------------------------------------------------//
Route::get('get_app_user/{id}', 'AppUsersController@show');
Route::post('create_app_user', 'AppUsersController@create');
// Cant use PUT when sending an image along with data in postman
// http://laravel.io/forum/02-13-2014-i-can-not-get-inputs-from-a-putpatch-request
Route::post('edit_app_user/{id}', 'AppUsersController@edit');
Route::delete('delete_app_user/{id}', 'AppUsersController@destroy');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------Posts Routes---------------------//
//--------------------------------------------------//
Route::get('get_all_posts/{category}', 'PostController@index');
Route::get('get_single_post/{id}', 'PostController@show');
Route::post('create_single_post', 'PostController@create');
Route::post('edit_single_post/{id}', 'PostController@edit');
Route::delete('delete_single_post/{id}', 'PostController@destroy');
Route::post('upvote_post/{id}','PostController@upvote');
Route::post('downvote_post/{id}','PostController@downvote');
Route::post('upvote_post_deduct/{id}','PostController@upvote_deduct');
Route::post('downvote_post_deduct/{id}','PostController@downvote_deduct');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------Comments Routes------------------//
//--------------------------------------------------//
Route::get('get_all_comments/{post_id}', 'CommentController@index');
Route::post('create_single_comment', 'CommentController@create');
Route::post('edit_single_comment/{comment_id}', 'CommentController@edit');
Route::delete('delete_single_comment/{comment_id}', 'CommentController@destroy');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------Awards Routes--------------------//
//--------------------------------------------------//
Route::get('get_all_awards', 'AwardsController@index');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------Categories Routes----------------//
//--------------------------------------------------//
Route::get('get_all_categories', 'CategoryController@index');
Route::get('subscribe_category/{user_id}/{category}','CategoryController@subscribe');
Route::get('unsubscribe_category/{user_id}/{category}','CategoryController@unsubscribe');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------LiftMeUp Routes------------------//
//--------------------------------------------------//
Route::get('get_single_link/{type}', 'LiftMeUpController@index');
//----------------------------------------------------//


//----------------------------------------------------//
//------------------Notifications Routes-------------//
//--------------------------------------------------//
Route::get('get_all_notifications/{user_id}', 'NotificationController@index');
Route::get('get_unread_notifications/{user_id}', 'NotificationController@indexUnread');
//Before passing messages to the route below, always replace the <space> with "_"
// It will automatically parse it to correct format.
// This is done to avoid complications with URLs
Route::get('create_new_notification/{category}/{message}', 'NotificationController@create');
Route::get('mark_read_notifications/{user_id}', 'NotificationController@edit');
//----------------------------------------------------//