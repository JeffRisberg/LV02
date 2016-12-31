<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/books', function () {
    return view('bookList');
});

Route::resource('my', 'MyController');

Route::get('test', 'TestController@getIndex');
Route::get('test/{id}', 'TestController@getShow');

Route::get('view-records', 'StudViewController@index');

Route::get('insert', 'StudInsertController@insertform');
Route::post('create', 'StudInsertController@insert');

/*  Vue.js  */
/*  Route::group(['middleware' => ['web']], function() {  */
/*  CITATION: https://laracasts.com/discuss/channels/laravel/middleware-web  */
Route::get('/vuejscrud', 'BlogController@vueCrud');
Route::resource('vueitems','BlogController');  /*  spawn a bunch of routes and actions off '/vueitems'  */
/*  CITATION - https://laravel.com/docs/5.3/controllers#resource-controllers  */

