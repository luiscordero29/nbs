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
/* vehicles_brands */
Route::match(['get', 'post'],'vehicles_brands/index', 'VehiclesBrandsController@index');
Route::get('vehicles_brands/create', 'VehiclesBrandsController@create');
Route::post('vehicles_brands/store', 'VehiclesBrandsController@store');
Route::get('vehicles_brands/show/{vehicle_brand_id}', 'VehiclesBrandsController@show')->where('vehicle_brand_id', '[0-9]+');
Route::get('vehicles_brands/edit/{vehicle_brand_id}', 'VehiclesBrandsController@edit')->where('vehicle_brand_id', '[0-9]+');
Route::post('vehicles_brands/update/{vehicle_brand_id}', 'VehiclesBrandsController@update')->where('vehicle_brand_id', '[0-9]+');
Route::get('vehicles_brands/destroy/{vehicle_brand_id}', 'VehiclesBrandsController@destroy')->where('vehicle_brand_id', '[0-9]+');
/* vehicles_models */
Route::match(['get', 'post'],'vehicles_models/index', 'VehiclesModelsController@index');
Route::get('vehicles_models/create', 'VehiclesModelsController@create');
Route::post('vehicles_models/store', 'VehiclesModelsController@store');
Route::get('vehicles_models/show/{vehicle_model_id}', 'VehiclesModelsController@show')->where('vehicle_model_id', '[0-9]+');
Route::get('vehicles_models/edit/{vehicle_model_id}', 'VehiclesModelsController@edit')->where('vehicle_model_id', '[0-9]+');
Route::post('vehicles_models/update/{vehicle_model_id}', 'VehiclesModelsController@update')->where('vehicle_model_id', '[0-9]+');
Route::get('vehicles_models/destroy/{vehicle_model_id}', 'VehiclesModelsController@destroy')->where('vehicle_model_id', '[0-9]+');
