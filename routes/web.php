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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  Route::group(['middleware' => 'checkrole'], function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    // admin approve
    Route::get('users/status', 'UserController@approveIndex')->name('users.status');
    Route::put('users/approve/{user}', 'UserController@approve')->name('users.approve');
    Route::put('users/noapprove/{user}', 'UserController@noapprove')->name('users.noapprove');
  });
  Route::get('/home', 'HomeController@index')->name('home');
});
