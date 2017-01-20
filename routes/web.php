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

Route::get('/','PostController@index');
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);
    Route::get('/post/new','PostController@create');
    Route::post('/post/new','PostController@store');
    Route::get('/edit/{slug}','PostController@edit');
    Route::get('/show/{slug}','PostController@show');
    Route::post('/post/update','PostController@update');
    Route::get('delete/{id}','PostController@delete');
});


Auth::routes();
