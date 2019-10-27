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
    return view('welcome', [
        'posts' => App\Post::orderBy('created_at', 'desc')->get()
    ]);
});

Auth::routes();

Route::get('/u', 'ProfilesController@index')->name('profiles');
Route::get('/u/{username}', 'ProfilesController@show')->name('profile');
Route::patch('/u/{username}', 'ProfilesController@edit')->name('profileUpdate');
Route::get('/admin', 'ProfilesController@dashboard')->name('admin');

Route::get('/p/create', 'PostsController@create')->name('pCreate');
Route::post('/p', 'PostsController@store')->name('p');
Route::get('/p/{id}', 'PostsController@show')->name('pShow');
Route::post('/p/{id}/comment', 'CommentsController@store')->name('comment');
