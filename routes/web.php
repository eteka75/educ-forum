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


Route::group(['prefix' => config('forum.routes.home')], function () {
\Carbon\Carbon::setLocale(config('app.locale'));
    
    Route::get('/', 'PageController@index'); /* Page d'accueil */
    Route::get(config('forum.routes.catgory') . 'category/{slug}/', 'DiscussionController@showCategorie'); /* Affichage des sujets par catégorie */
    // Afficher une seul discussion
    Route::get(config('forum.routes.discussion') . '/{category}/{slug}', [
        'as' => 'showInCategory',
        'uses' => 'DiscussionController@show',
        'middleware' => 'web',
    ]);
    // Afficher le profil de l'utilisateur
    Route::get('/profil', [
        'as' => 'showProfil',
        'uses' => 'Forum\UserController@profil',
        'middleware' => 'auth',
    ]);
    
});
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
//Route::get('profil', 'HomeController@home');
//Route::get('settings', 'UserController@settings');
//Route::get('settings', 'UserController@settings');
//Route::get('cercles', 'cercles');
//Route::get('{user}/discussion/', 'cercles');
Route::get('/ajax/posts/','DiscussionController@getAjaxList');