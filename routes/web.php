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

Route::get('/', 'PostsController@index')->name('posts.index');
Route::get('/{post}', 'PostsController@show')->name('posts.show');
Route::post('posts/suggest', 'PostsController@suggest')->name('posts.suggest');

Route::get('search', 'SearchController@index')->name('search');
Route::post('search', 'SearchController@suggest')->name('search');