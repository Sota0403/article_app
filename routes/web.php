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

Route::group(['middleware' => 'auth'], function() {
  Route::get('/', 'ArticleController@index')->name('article.index');
  Route::post('/article', 'ArticleController@store')->name('article.store');
  Route::get('/article/create', 'ArticleController@create')->name('article.create');
  // Route::get('/article/mypage', 'ArticleController@showMypage')->name('article.mypage');
  Route::post('/article/confirm/{article_id?}', 'ArticleController@confirm')->name('article.comfirm');
  Route::get('/article/{article_id}', 'ArticleController@show')->name('article.show');
  Route::put('/article/{article_id}', 'ArticleController@update')->name('article.update');
  Route::delete('/article/{article_id}', 'ArticleController@delete')->name('article.delete');
  Route::get('/article/{article_id}/edit', 'ArticleController@edit')->name('article.edit');
  Route::get('/like/{article_id}', 'ArticleController@addLike')->name('article.like');
  Route::get('/unlike/{article_id}', 'ArticleController@unLike')->name('article.unlike');

  Route::get('/mypage', 'UserController@showMypage')->name('user.mypage');
  Route::put('/mypage', 'UserController@updateMypage')->name('user.mypage.update');
  Route::get('/profile/{user_id}', 'UserController@showUser')->name('user.profile');

  Route::post('/follow/{user_id}', 'followController@followUser')->name('follow');
});

Auth::routes();
Route::get('/update_password', 'TopController@editFirstLoginPassword')->name('editFirstLoginPassword');
Route::put('/update_password', 'TopController@updateFirstLoginPassword')->name('updateFirstLoginPassword.store');
