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

//ブログ一覧を表示
Route::get('/', 'BlogController@showList')->name('blogs');

//ブログ登録画面を表示
Route::get('/blog/create', 'BlogController@showCreate')->name('create');

//ブログを登録する
Route::post('/blog/store', 'BlogController@exeStore')->name('store');
//表示するのがshow, 実行するのがexe

//ブログ詳細を表示
Route::get('/blog/{id}', 'BlogController@showDetail')->name('show');


//ブログ編集画面を表示
Route::get('/blog/edit/{id}', 'BlogController@showEdit')->name('edit');

//ブログ編集を適用する
Route::post('/blog/update', 'BlogController@exeUpdate')->name('update');
//表示するのがshow, 実行するのがexe

//ブログ記事を削除する
Route::post('/blog/delete/{id}', 'BlogController@exeDelete')->name('delete');
