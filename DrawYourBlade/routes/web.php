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

//posts
//to create a new post
Route::get('/newPost', 'PostCRUD@createView')->name('newPost');

Route::put('/newPost', 'PostCRUD@create');

//to see all the posts
Route::get('/', 'PostCRUD@showAllPosts')->name('index');

//to see info about a particular one
Route::get('/post/{postID}', 'PostCRUD@showSinglePost')->name('showPost');

//to edit an existing post
Route::get('/post/{postID}/edit', 'PostCRUD@editView');

Route::put('/post/{postID}/edit', 'PostCRUD@edit');

//to delete an existing post
Route::get('/post/{postID}/delete', 'PostCRUD@removeView');

Route::put('/post/{postID}/delete', 'PostCRUD@remove');


//admin section
Route::get('/usersOverview/', 'UsersController@AllProfiles')->middleware('IsAdmin');

//users
//to see a particular profile
Route::get('/profile/{id}', 'UsersController@Profile')->middleware('auth')->name('profile');

//to download all the user data
Route::get('/getUserData', 'UsersController@getDataView')->middleware('IsAdmin');
Route::put('/getUserData', 'UsersController@getData')->middleware('IsAdmin');

//to edit a profile
Route::get('/editProfile/{id}', 'UsersController@EditProfileView')->middleware(
    'auth', 'ProfilePossession');

Route::put('/editProfile/{id}', 'UsersController@EditProfileData')->middleware(
    'auth', 'ProfilePossession');
	
//to change a user's role
Route::put('/changeType/{id}', 'UsersController@EditUserType')->middleware(
	'auth', 'IsAdmin');

//to delete a user
Route::get('/profile/{userID}/delete', 'UsersController@GetRemoveView')->middleware(
	'auth', 'IsAdmin');
	
Route::put('/profile/{userID}/delete', 'UsersController@RemoveUser')->middleware(
	'auth', 'IsAdmin');
	
//to change the avatar
Route::get('/changeAvatar/{id}', 'UsersController@ChangeAvatarView')->middleware(
    'auth', 'ProfilePossession');
	
Route::put('/changeAvatar/{id}', 'UsersController@ChangeAvatar')->middleware(
    'auth', 'ProfilePossession');

// users api crud
Route::get('/readUser/{id}', 'UsersApiController@show')->middleware(
    'auth', 'ProfilePossession');

Route::get('/deleteUser/{id}', 'UsersApiController@delete')->middleware(
    'auth', 'ProfilePossession');

Route::get('/readAllUsers', 'UsersApiController@showAll');

// comment post
Route::put('/newComment/{post_id}', 'CommentController@create');

Auth::routes();

Route::get('/home', 'HomeController@index');
