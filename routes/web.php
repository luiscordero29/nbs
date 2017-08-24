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
/* home */
Route::get('/', 'HomeController@index');
/* dashboar */
Route::get('/dashboard', 'DashboardController@index');
/* roles */
Route::match(['get', 'post'],'roles/index', 'RolesController@index');
Route::get('roles/create', 'RolesController@create');
Route::post('roles/store', 'RolesController@store');
Route::get('roles/show/{rol_id}', 'RolesController@show')->where('rol_id', '[0-9]+');
Route::get('roles/edit/{rol_id}', 'RolesController@edit')->where('rol_id', '[0-9]+');
Route::post('roles/update/{rol_id}', 'RolesController@update')->where('rol_id', '[0-9]+');
Route::get('roles/destroy/{rol_id}', 'RolesController@destroy')->where('rol_id', '[0-9]+');
/* users */
Route::match(['get', 'post'],'users/index', 'UsersController@index');
Route::get('users/create', 'UsersController@create');
Route::post('users/store', 'UsersController@store');
Route::get('users/show/{user_id}', 'UsersController@show')->where('user_id', '[0-9]+');
Route::get('users/edit/{user_id}', 'UsersController@edit')->where('user_id', '[0-9]+');
Route::post('users/update/{user_id}', 'UsersController@update')->where('user_id', '[0-9]+');
Route::get('users/destroy/{user_id}', 'UsersController@destroy')->where('user_id', '[0-9]+');
/* users_types */
Route::match(['get', 'post'],'users_types/index', 'UsersTypesController@index');
Route::get('users_types/create', 'UsersTypesController@create');
Route::post('users_types/store', 'UsersTypesController@store');
Route::get('users_types/show/{user_type_id}', 'UsersTypesController@show')->where('user_type_id', '[0-9]+');
Route::get('users_types/edit/{user_type_id}', 'UsersTypesController@edit')->where('user_type_id', '[0-9]+');
Route::post('users_types/update/{user_type_id}', 'UsersTypesController@update')->where('user_type_id', '[0-9]+');
Route::get('users_types/destroy/{user_type_id}', 'UsersTypesController@destroy')->where('user_type_id', '[0-9]+');
/* users_positions */
Route::match(['get', 'post'],'users_positions/index', 'UsersPositionsController@index');
Route::get('users_positions/create', 'UsersPositionsController@create');
Route::post('users_positions/store', 'UsersPositionsController@store');
Route::get('users_positions/show/{user_position_id}', 'UsersPositionsController@show')->where('user_position_id', '[0-9]+');
Route::get('users_positions/edit/{user_position_id}', 'UsersPositionsController@edit')->where('user_position_id', '[0-9]+');
Route::post('users_positions/update/{user_position_id}', 'UsersPositionsController@update')->where('user_position_id', '[0-9]+');
Route::get('users_positions/destroy/{user_position_id}', 'UsersPositionsController@destroy')->where('user_position_id', '[0-9]+');
/* users_divisions */
Route::match(['get', 'post'],'users_divisions/index', 'UsersDivisionsController@index');
Route::get('users_divisions/create', 'UsersDivisionsController@create');
Route::post('users_divisions/store', 'UsersDivisionsController@store');
Route::get('users_divisions/show/{user_division_id}', 'UsersDivisionsController@show')->where('user_division_id', '[0-9]+');
Route::get('users_divisions/edit/{user_division_id}', 'UsersDivisionsController@edit')->where('user_division_id', '[0-9]+');
Route::post('users_divisions/update/{user_division_id}', 'UsersDivisionsController@update')->where('user_division_id', '[0-9]+');
Route::get('users_divisions/destroy/{user_division_id}', 'UsersDivisionsController@destroy')->where('user_division_id', '[0-9]+');
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
/* vehicles_types */
Route::match(['get', 'post'],'vehicles_types/index', 'VehiclesTypesController@index');
Route::get('vehicles_types/create', 'VehiclesTypesController@create');
Route::post('vehicles_types/store', 'VehiclesTypesController@store');
Route::get('vehicles_types/show/{vehicle_type_id}', 'VehiclesTypesController@show')->where('vehicle_type_id', '[0-9]+');
Route::get('vehicles_types/edit/{vehicle_type_id}', 'VehiclesTypesController@edit')->where('vehicle_type_id', '[0-9]+');
Route::post('vehicles_types/update/{vehicle_type_id}', 'VehiclesTypesController@update')->where('vehicle_type_id', '[0-9]+');
Route::get('vehicles_types/destroy/{vehicle_type_id}', 'VehiclesTypesController@destroy')->where('vehicle_type_id', '[0-9]+');
