<?php
use App\Http\Controllers\Blog\PostController;
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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}', [PostController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category}', [PostController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{tag}', [PostController::class, 'tag'])->name('blog.tag');
Route::get('/blog/posts/user/{user}', [PostController::class, 'showuser'])->name('blog.showuser');

Auth::routes();

Route::middleware('auth')->group(function() {
  Route::middleware('checkrole', 'checkapprove')->group(function() {
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    // self update profile
    Route::get('action', 'SearchController@action')->name('search.action');
    Route::get('user/edit', 'UserController@selfEdit')->name('user.edit');
    Route::put('user/update/{user}', 'UserController@selfUpdate')->name('user.update');
    // comment
    Route::resource('comment', 'CommentController');

    Route::middleware('admin')->group(function() {
      // admin approve
      Route::get('users/status', 'UserController@approveIndex')->name('users.status');
      Route::put('users/approve/{user}', 'UserController@approve')->name('users.approve');
      Route::put('users/noapprove/{user}', 'UserController@noapprove')->name('users.noapprove');
      // check staus user
      Route::get('users/detail', 'UserController@detailIndex')->name('users.detail');
      Route::get('users/details', 'UserController@search')->name('users.search');
      Route::get('users/edit/{user}', 'UserController@edit')->name('users.edit');
      Route::put('users/update/{user}', 'UserController@update')->name('users.update');
      Route::delete('users/delete/{user}', 'UserController@destroy')->name('users.delete');
      // detail admin
      Route::resource('admin', 'MakeAdminController');
    });
  });
  Route::get('/home', 'HomeController@index')->name('home');
});
