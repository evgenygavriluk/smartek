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

Route::get('/', ['as'=>'index', 'uses'=>'IndexController@index']);

Route::get('biblioteka', ['as'=>'biblioteka', 'uses' => 'BibliotekaController@index']);
Route::get('biblioteka/{bibliotekaid}', ['as'=>'biblioteka/bibliotekaid', 'uses'=>'BibliotekaController@element']);
Route::get('biblioteka/{bibliotekaid}/page/{pageid}', ['as'=>'biblPage', 'uses'=>'BibliotekaController@element']);
Route::get('biblioteka/{bibliotekaid}/{authorid}/page/{pageid}', ['as'=>'biblPageAuthor/authorid', 'uses'=>'BibliotekaController@element']);
Route::get('biblioteka/{bibliotekaid}/{authorid}/page/{pageid}/{sortrule}', ['as'=>'biblPageAuthor/sortrule', 'uses'=>'BibliotekaController@element']);

Route::get('book', ['as'=>'book', 'uses' => 'BookController@index']);
Route::get('book/{bookid}', ['as'=>'book/bookid', 'uses'=>'BookController@element']);
Route::get('book/page/{pageid}', ['as'=>'bookPage', 'uses'=>'BookController@index']);
Route::get('book/{authorid}/page/{pageid}', ['as'=>'bookPageAuthor/authorid', 'uses'=>'BookController@index']);
Route::get('book/{authorid}/page/{pageid}/{sortrule}', ['as'=>'bookPageAuthor/sortrule', 'uses'=>'BookController@index']);

Route::get('author', ['as'=>'author', 'uses' => 'AuthorController@index']);
Route::get('author/{authorid}', ['as'=>'author/authorid','uses'=>'AuthorController@element']);
Route::get('author/page/{pageid}', ['as'=>'authorPage', 'uses'=>'AuthorController@index']);


Route::get('/test', 'TestController@index');

