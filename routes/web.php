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
})->name('home');

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::get('/dashboard', [
    'uses' => 'PostController@getDashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::get('/logout', [
    'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::get('/account', [
    'uses' => 'UserController@getAccount',
    'as' => 'account',
    'middleware' => 'auth'
]);

Route::post('/accountedit', [
    'uses' => 'UserController@postAccountEdit',
    'as' => 'account.edit',
    'middleware' => 'auth'
]);

Route::get('/accountimage{filename}', [
    'uses' => 'Usercontroller@getAccountImage',
    'as' => 'account.image'
]);

Route::post('/createpost', [
    'uses' => 'PostController@postCreatePost',
    'as' => 'post.create',
    'middleware' => 'auth'
]);

Route::get('/deletepost/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);

Route::post('/editpost', [
    'uses' => 'PostController@postEditPost',
    'as' => 'editpost',
    'middleware' => 'auth'
]);

Route::post('/likepost', [
    'uses' => 'PostController@postLikePost',
    'as' => 'likepost',
    'middleware' => 'auth'
]);

Route::post('/notif', [
    'uses' => 'PostController@postSession',
    'as' => 'notif'
]);