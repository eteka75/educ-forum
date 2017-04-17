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
    Route::get('/home', 'PageController@index'); /* Page d'accueil */
    Route::get(config('forum.routes.category') . '/{slug}/', 'Forum\DiscussionController@showCategorie')->name('categorie'); /* Affichage des sujets par catégorie */
    // Afficher une seul discussion
    Route::get(config('forum.routes.discussion') . '/{category}/{slug}', [
        'as' => 'showInCategory',
        'uses' => 'Forum\DiscussionController@show',
        'middleware' => 'web',
    ]);
    
    Route::get(config('forum.routes.sujets') .'/all/', [
        'as' => 'showAllSujets',
        'uses' => 'Forum\DiscussionController@showAllSujets',
//        'middleware' => 'auth',
    ]);
    Route::get(config('forum.routes.sujets') .'/favoris/', [
        'as' => 'showFavorisSujets',
        'uses' => 'Forum\DiscussionController@showFavorisSujets',
//        'middleware' => 'auth',
    ]);
    Route::get(config('forum.routes.sujets') .'/user/', [
        'as' => 'showUserSujets',
        'uses' => 'Forum\DiscussionController@showUserSujets',
        'middleware' => 'auth',
    ]);
    Route::get(config('forum.routes.sujets') .'/user', [
        'as' => 'showLoginUserSujets',
        'uses' => 'Forum\DiscussionController@showUserSujets',
        'middleware' => 'auth',
    ]);
    Route::get(config('forum.routes.discussion') .'/user/', [
        'as' => 'showUserDiscussions',
        'uses' => 'Forum\DiscussionController@showUserDiscussions',
        'middleware' => 'auth',
    ]);
    Route::get(config('forum.routes.all') ."-".config('forum.routes.category') .'/', [
        'as' => 'showAllCategory',
        'uses' => 'Forum\DiscussionController@showAllCategory',
//        'middleware' => 'guest',
    ]);
    // Afficher le profil de l'utilisateur
    Route::get('/profil', [
        'as' => 'showProfil',
        'uses' => 'Forum\UserController@profil',
        'middleware' => 'auth',
    ]);
    Route::get('/profil/{id}', [
        'as' => 'userProfil',
        'uses' => 'Forum\UserController@profil',
//        'middleware' => 'guest',
    ]);
    Route::get('/notification/', [
        'as' => 'userNotifications',
        'uses' => 'Forum\UserController@userNotifications',
        'middleware' => 'auth',
    ]);
    Route::get('/profil/{id}/'.config('forum.routes.sujets'), [
        'as' => 'userProfilSujets',
        'uses' => 'Forum\UserController@profil',
//        'middleware' => ['web','Auth'],
    ]);
    Route::get('/'.config('forum.routes.sujets'), [
        'as' => 'AllSujets',
        'uses' => 'Forum\UserController@AllSujets',
        'middleware' => 'guest',
    ]);
    Route::get('/search', [
        'as' => 'AllSujets',
        'uses' => 'Forum\UserController@search',
        'middleware' => 'guest',
    ]);
    /*MISE A JOUR SUJETS*/
    Route::get('/sujets/new', [
        'as' => 'NewSujet',
        'uses' => 'Forum\UserController@NewSujet',
        'middleware' => 'auth',
    ]);
    Route::post('/sujets/new', [
        'as' => 'SaveNewSujet',
        'uses' => 'Forum\UserController@SaveNewSujet',
        'middleware' => 'auth',
    ]);
    Route::post('/sujets/{id}/update', [
        'as' => 'UpdateSujet',
        'uses' => 'Forum\UserController@UpdateSujet',
        'middleware' => 'auth',
    ]);
    Route::delete('/sujets/{id}/delete', [
        'as' => 'DeleteSujet',
        'uses' => 'Forum\UserController@UpdateSujet',
        'middleware' => 'auth',
    ]);
    /*MISE A JOUR COMMENTAIRES*/
    Route::post('/comments/new/{id}', [
        'as' => 'NewComment',
        'uses' => 'Forum\UserController@NewComment',
        'middleware' => 'auth',
    ]);
    
    Route::get('/comments/{id}/update', [
        'as' => 'UpdateComment',
        'uses' => 'Forum\UserController@UpdateComment',
        'middleware' => 'auth',
    ]);
    
    Route::post('/comments/{id}/update', [
        'as' => 'SaveUpdateComment',
        'uses' => 'Forum\UserController@SaveUpdateComment',
        'middleware' => 'auth',
    ]);
    
    Route::delete('/comments/{id}/delete', [
        'as' => 'DeleteComment',
        'uses' => 'Forum\UserController@DeleteComment',
        'middleware' => 'auth',
    ]);
    Route::post('/comments/{id}/vote', [
        'as' => 'SaveVoteComment',
        'uses' => 'Forum\UserController@SaveVoteComment',
        'middleware' => 'auth',
    ]);
    
    Route::get('/profil/update', [
        'as' => 'UpdateProfil',
        'uses' => 'Forum\UserController@UpdateProfil',
        'middleware' => 'auth',
    ]);
    Route::post('/profil/update', [
        'as' => 'SaveUpdateProfil',
        'uses' => 'Forum\UserController@SaveUpdateProfil',
        'middleware' => 'auth',
    ]);
    /* Mot de passe */
    Route::get('/profil/change-password', [
        'as' => 'ChangePassword',
        'uses' => 'Forum\UserController@ChangePassword',
        'middleware' => 'auth',
    ]);
    Route::post('/profil/change-password', [
        'as' => 'SaveChangePassword',
        'uses' => 'Forum\UserController@SaveChangePassword',
        'middleware' => 'auth',
    ]);
    /*Affichage et envoie de données*/
    Route::get('/settings', [
        'as' => 'SettingProfil',
        'uses' => 'Forum\UserController@SettingProfil',
        'middleware' => 'auth',
    ]);
    Route::post('/settings', [
        'as' => 'SaveSettingProfil',
        'uses' => 'Forum\UserController@SaveSettingProfil',
        'middleware' => 'auth',
    ]);
    /*Aide à l'Utilisation*/
    Route::get('/faq', [
        'as' => 'FaqForum',
        'uses' => 'Forum\UserController@FaqForum',
        'middleware' => 'guest',
    ]);
    Route::get('/regles-confidentialite', [
        'as' => 'Reglements',
        'uses' => 'Forum\UserController@Reglements',
        'middleware' => 'guest',
    ]);
    Route::get('/contact', [
        'as' => 'Contact',
        'uses' => 'Forum\UserController@Contact',
        'middleware' => 'guest',
    ]);
    /*Signaler une erreure*/
    Route::get('/feedback', [
        'as' => 'FeedBack',
        'uses' => 'Forum\UserController@FeedBack',
        'middleware' => 'guest',
    ]);
    Route::post('/feedback', [
        'as' => 'FeedBack',
        'uses' => 'Forum\UserController@SaveFeedBack',
        'middleware' => 'guest',
    ]);
    Route::post('/feedback', [
        'as' => 'FeedBack',
        'uses' => 'Forum\UserController@SaveFeedBack',
        'middleware' => 'guest',
    ]);
    Route::get('/membres', [
        'as' => 'Members',
        'uses' => 'Forum\UserController@Members',
        'middleware' => 'guest',
    ]);
    Route::get('/membres/university/{id}', [
        'as' => 'UniversityMembers',
        'uses' => 'Forum\UserController@UniversityMembers',
        'middleware' => 'guest',
    ]);
    
    
});
Auth::routes();
Route::get('/', 'PageController@index');

Route::get('/home', 'PageController@index');
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
Route::get('/ajax/posts/','Forum\DiscussionController@getAjaxList');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');
Route::resource('categories', 'Forum\\CategoriesController');