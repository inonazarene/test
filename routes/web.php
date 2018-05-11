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

//   $photo = \App\Photo::with('tags')->get();

//   dd($photo);

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/store','HomeController@store')->name('photo.upload');
Route::get('/home/photo','HomeController@show')->name('photo.show');

Route::post('/home/store_tags','HomeController@storeTags')->name('tag.store');
