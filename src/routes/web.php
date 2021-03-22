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

Route::get('/', 'Controller@authCheck');

Auth::routes();

Route::resource('users', 'UserController')->middleware('auth');;
Route::resource('posts', 'PostController');

Route::get('/follows/cancel/{id}', 'FollowController@cancel');
Route::get('/follows/add/{id}', 'FollowController@add');