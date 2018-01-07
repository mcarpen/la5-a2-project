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

Route::get('/', 'WelcomeController@welcome');
Route::get('/mes-articles', 'UserController@articles');

Route::resource('/blog', 'BlogController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/comment', 'CommentsController');
Route::post('/blog/{slug}/comments', ['as' => 'comment.store', 'uses' => 'CommentController@store']);