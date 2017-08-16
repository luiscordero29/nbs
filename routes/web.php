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
/* Auth */
Auth::routes();
Route::get('/',function () {
    return redirect('login');
});
/* dashboar */
Route::get('/home', 'HomeController@index')->name('home');
/* types */
Route::match(['get', 'post'],'types/index', 'TypesController@index');
Route::get('types/create', 'TypesController@create');
Route::post('types/store', 'TypesController@store');
Route::get('types/show/{type_id}', 'TypesController@show')->where('type_id', '[0-9]+');
Route::get('types/edit/{type_id}', 'TypesController@edit')->where('type_id', '[0-9]+');
Route::post('types/update/{type_id}', 'TypesController@update')->where('type_id', '[0-9]+');
Route::get('types/destroy/{type_id}', 'TypesController@destroy')->where('type_id', '[0-9]+');
