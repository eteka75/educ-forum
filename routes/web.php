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



Auth::routes();
Route::get('/', 'PageController@index');
Route::get('/home', 'HomeController@home');
Route::post('sujets/new', 'Forum\\SujetsController@store');
Route::get('sujets/new', 'Forum\\SujetsController@store');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('discussions', 'Forum\\DiscussionsController');
Route::resource('posts', 'Forum\\PostsController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('domaines', 'Forum\\DomainesController');