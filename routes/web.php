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


Route::get('/article', 'ArticleController@index')->name('article.index');
Route::post('/article', 'ArticleController@store')->name('article.store');
Route::get('/article/create', 'ArticleController@create')->name('article.create');
Route::get('/article/{article_id}', 'ArticleController@show')->name('article.show');
Route::put('/article/{question_id}', 'ArticleController@update')->name('article.update');
Route::delete('/article/{article_id}', 'ArticleController@delete')->name('article.delete');
Route::get('/article/{article_id}/edit', 'ArticleController@edit')->name('article.edit');

