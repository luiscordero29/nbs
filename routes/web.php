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
Route::get('home', 'DashboardController@index');
Route::get('dashboard', 'DashboardController@index');
Route::get('auth', 'DashboardController@auth');
/* profile */
Route::get('dashboard/profile', 'DashboardController@profile');
Route::get('dashboard/profile/edit', 'DashboardController@profile_edit');
Route::post('dashboard/profile/edit/store', 'DashboardController@profile_edit_store');
Route::get('dashboard/profile/upload', 'DashboardController@profile_upload');
Route::post('dashboard/profile/upload/store', 'DashboardController@profile_upload_store');
Route::get('dashboard/profile/password', 'DashboardController@profile_password');
Route::post('dashboard/profile/password/store', 'DashboardController@profile_password_store');
########################
# User
########################
/* user_vehicles */
Route::get('user_vehicles/index', 'UserVehiclesController@index');
Route::get('user_vehicles/create', 'UserVehiclesController@create');
Route::post('user_vehicles/store', 'UserVehiclesController@store');
Route::get('user_vehicles/show/{vehicle_id}', 'UserVehiclesController@show')->where('vehicle_id', '[0-9]+');
Route::get('user_vehicles/edit/{vehicle_id}', 'UserVehiclesController@edit')->where('vehicle_id', '[0-9]+');
Route::post('user_vehicles/update/{vehicle_id}', 'UserVehiclesController@update')->where('vehicle_id', '[0-9]+');
Route::get('user_vehicles/destroy/{vehicle_id}', 'UserVehiclesController@destroy')->where('vehicle_id', '[0-9]+');
Route::get('user_vehicles/getbrands/{vehicle_type_name}', 'UserVehiclesController@getbrands');
Route::get('user_vehicles/getmodels/{vehicle_brand_name}', 'UserVehiclesController@getmodels');
########################
# Administration
########################
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
/* users_vehicles */
Route::get('users_vehicles/index/{user_id}', 'UsersVehiclesController@index')->where('user_id', '[0-9]+');
Route::get('users_vehicles/create/{user_id}', 'UsersVehiclesController@create')->where('user_id', '[0-9]+');
Route::post('users_vehicles/store/{user_id}', 'UsersVehiclesController@store')->where('user_id', '[0-9]+');
Route::get('users_vehicles/show/{user_id}/{vehicle_id}', 'UsersVehiclesController@show')->where('user_id', '[0-9]+')->where('vehicle_id', '[0-9]+');
Route::get('users_vehicles/edit/{user_id}/{vehicle_id}', 'UsersVehiclesController@edit')->where('user_id', '[0-9]+')->where('vehicle_id', '[0-9]+');
Route::post('users_vehicles/update/{user_id}/{vehicle_id}', 'UsersVehiclesController@update')->where('user_id', '[0-9]+')->where('vehicle_id', '[0-9]+');
Route::get('users_vehicles/destroy/{user_id}/{vehicle_id}', 'UsersVehiclesController@destroy')->where('user_id', '[0-9]+')->where('vehicle_id', '[0-9]+');
Route::get('users_vehicles/getbrands/{vehicle_type_name}', 'UsersVehiclesController@getbrands');
Route::get('users_vehicles/getmodels/{vehicle_brand_name}', 'UsersVehiclesController@getmodels');
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
/* vehicles */
Route::match(['get', 'post'],'vehicles/index', 'VehiclesController@index');
Route::get('vehicles/create', 'VehiclesController@create');
Route::post('vehicles/store', 'VehiclesController@store');
Route::get('vehicles/show/{vehicle_id}', 'VehiclesController@show')->where('vehicle_id', '[0-9]+');
Route::get('vehicles/edit/{vehicle_id}', 'VehiclesController@edit')->where('vehicle_id', '[0-9]+');
Route::post('vehicles/update/{vehicle_id}', 'VehiclesController@update')->where('vehicle_id', '[0-9]+');
Route::get('vehicles/destroy/{vehicle_id}', 'VehiclesController@destroy')->where('vehicle_id', '[0-9]+');
Route::get('vehicles/getbrands/{vehicle_type_name}', 'VehiclesController@getbrands');
Route::get('vehicles/getmodels/{vehicle_brand_name}', 'VehiclesController@getmodels');
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
Route::get('vehicles_models/getbrands/{vehicle_type_name}', 'VehiclesModelsController@getbrands');
/* vehicles_types */
Route::match(['get', 'post'],'vehicles_types/index', 'VehiclesTypesController@index');
Route::get('vehicles_types/create', 'VehiclesTypesController@create');
Route::post('vehicles_types/store', 'VehiclesTypesController@store');
Route::get('vehicles_types/show/{vehicle_type_id}', 'VehiclesTypesController@show')->where('vehicle_type_id', '[0-9]+');
Route::get('vehicles_types/edit/{vehicle_type_id}', 'VehiclesTypesController@edit')->where('vehicle_type_id', '[0-9]+');
Route::post('vehicles_types/update/{vehicle_type_id}', 'VehiclesTypesController@update')->where('vehicle_type_id', '[0-9]+');
Route::get('vehicles_types/destroy/{vehicle_type_id}', 'VehiclesTypesController@destroy')->where('vehicle_type_id', '[0-9]+');
/* vehicles_colors */
Route::match(['get', 'post'],'vehicles_colors/index', 'VehiclesColorsController@index');
Route::get('vehicles_colors/create', 'VehiclesColorsController@create');
Route::post('vehicles_colors/store', 'VehiclesColorsController@store');
Route::get('vehicles_colors/show/{vehicle_color_id}', 'VehiclesColorsController@show')->where('vehicle_color_id', '[0-9]+');
Route::get('vehicles_colors/edit/{vehicle_color_id}', 'VehiclesColorsController@edit')->where('vehicle_color_id', '[0-9]+');
Route::post('vehicles_colors/update/{vehicle_color_id}', 'VehiclesColorsController@update')->where('vehicle_color_id', '[0-9]+');
Route::get('vehicles_colors/destroy/{vehicle_color_id}', 'VehiclesColorsController@destroy')->where('vehicle_color_id', '[0-9]+');
/* parkings_sections */
Route::match(['get', 'post'],'parkings_sections/index', 'ParkingsSectionsController@index');
Route::get('parkings_sections/create', 'ParkingsSectionsController@create');
Route::post('parkings_sections/store', 'ParkingsSectionsController@store');
Route::get('parkings_sections/show/{parking_section_id}', 'ParkingsSectionsController@show')->where('parking_section_id', '[0-9]+');
Route::get('parkings_sections/edit/{parking_section_id}', 'ParkingsSectionsController@edit')->where('parking_section_id', '[0-9]+');
Route::post('parkings_sections/update/{parking_section_id}', 'ParkingsSectionsController@update')->where('parking_section_id', '[0-9]+');
Route::get('parkings_sections/destroy/{parking_section_id}', 'ParkingsSectionsController@destroy')->where('parking_section_id', '[0-9]+');
/* parkings_dimensions */
Route::match(['get', 'post'],'parkings_dimensions/index', 'ParkingsDimensionsController@index');
Route::get('parkings_dimensions/create', 'ParkingsDimensionsController@create');
Route::post('parkings_dimensions/store', 'ParkingsDimensionsController@store');
Route::get('parkings_dimensions/show/{parking_dimension_id}', 'ParkingsDimensionsController@show')->where('parking_dimension_id', '[0-9]+');
Route::get('parkings_dimensions/edit/{parking_dimension_id}', 'ParkingsDimensionsController@edit')->where('parking_dimension_id', '[0-9]+');
Route::post('parkings_dimensions/update/{parking_dimension_id}', 'ParkingsDimensionsController@update')->where('parking_dimension_id', '[0-9]+');
Route::get('parkings_dimensions/destroy/{parking_dimension_id}', 'ParkingsDimensionsController@destroy')->where('parking_dimension_id', '[0-9]+');
/* parkings */
Route::match(['get', 'post'],'parkings/index', 'ParkingsController@index');
Route::get('parkings/create', 'ParkingsController@create');
Route::post('parkings/store', 'ParkingsController@store');
Route::get('parkings/show/{parking_id}', 'ParkingsController@show')->where('parking_id', '[0-9]+');
Route::get('parkings/edit/{parking_id}', 'ParkingsController@edit')->where('parking_id', '[0-9]+');
Route::post('parkings/update/{parking_id}', 'ParkingsController@update')->where('parking_id', '[0-9]+');
Route::get('parkings/destroy/{parking_id}', 'ParkingsController@destroy')->where('parking_id', '[0-9]+');
/* parkings_lot */
Route::get('parkings_lot/create', 'ParkingsLotController@create');
Route::post('parkings_lot/store', 'ParkingsLotController@store');
/* booking */
Route::match(['get', 'post'],'booking/index', 'BookingController@index');
Route::post('booking/store', 'BookingController@store');
Route::post('booking/destroy', 'BookingController@destroy');
Route::get('booking/getvehicles/{user_number_id}/{booking_date}', 'BookingController@getvehicles');

