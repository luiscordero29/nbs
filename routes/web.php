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
    \Mail::send('welcome', [], function ($message){
        $message->to('luis.cordero@webdiv.co')->subject('Expertphp.in - Testing mail');
    });
*/
/* Emails */
/* Auth */
Auth::routes();
Route::get('email', 'EmailController@index');
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
Route::middleware(UserMiddleware::class)->group(function () {
	/* user_vehicles */
	Route::match(['get', 'post'], 'user_vehicles/index', 'UserVehiclesController@index');
	Route::get('user_vehicles/create', 'UserVehiclesController@create');
	Route::post('user_vehicles/store', 'UserVehiclesController@store');
	Route::get('user_vehicles/show/{vehicle_uid}', 'UserVehiclesController@show');
	Route::get('user_vehicles/edit/{vehicle_uid}', 'UserVehiclesController@edit');
	Route::post('user_vehicles/update/{vehicle_uid}', 'UserVehiclesController@update');
	Route::get('user_vehicles/destroy/{vehicle_uid}', 'UserVehiclesController@destroy');
	Route::get('user_vehicles/getbrands/{vehicle_type_uid}', 'UserVehiclesController@getbrands');
	Route::get('user_vehicles/getmodels/{vehicle_brands_uid}', 'UserVehiclesController@getmodels');
	/* user_booking */
	Route::match(['get', 'post'],'user_booking/index', 'UserBookingController@index');
	Route::post('user_booking/store', 'UserBookingController@store');
	Route::post('user_booking/update', 'UserBookingController@update');
	Route::post('user_booking/destroy', 'UserBookingController@destroy');
	Route::get('user_booking/getvehicles/{user_uid}/{booking_date}', 'UserBookingController@getvehicles');
});
########################
# Admin
########################
Route::middleware(AdminMiddleware::class)->group(function () {
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
	Route::get('users/show/{user_uid}', 'UsersController@show');
	Route::get('users/edit/{user_uid}', 'UsersController@edit');
	Route::post('users/update/{user_uid}', 'UsersController@update');
	Route::get('users/destroy/{user_uid}', 'UsersController@destroy');
	/* users_vehicles */
	Route::match(['get', 'post'],'users_vehicles/index/{user_uid}', 'UsersVehiclesController@index');
	Route::get('users_vehicles/create/{user_uid}', 'UsersVehiclesController@create');
	Route::post('users_vehicles/store/{user_uid}', 'UsersVehiclesController@store');
	Route::get('users_vehicles/show/{user_uid}/{vehicle_uid}', 'UsersVehiclesController@show');
	Route::get('users_vehicles/edit/{user_uid}/{vehicle_uid}', 'UsersVehiclesController@edit');
	Route::post('users_vehicles/update/{user_uid}/{vehicle_uid}', 'UsersVehiclesController@update');
	Route::get('users_vehicles/destroy/{user_uid}/{vehicle_uid}', 'UsersVehiclesController@destroy');
	Route::get('users_vehicles/getbrands/{vehicle_type_name}', 'UsersVehiclesController@getbrands');
	Route::get('users_vehicles/getmodels/{vehicle_brand_name}', 'UsersVehiclesController@getmodels');
	/* users_booking */
	Route::match(['get', 'post'],'users_booking/index/{user_uid}', 'UsersBookingController@index');
	Route::post('users_booking/store/{user_uid}', 'UsersBookingController@store');
	Route::post('users_booking/update/{user_uid}', 'UsersBookingController@update');
	Route::post('users_booking/destroy/{user_uid}', 'UsersBookingController@destroy');
	Route::get('users_booking/getvehicles/{user_number_id}/{booking_date}', 'UsersBookingController@getvehicles');
	/* users_types */
	Route::match(['get', 'post'],'users_types/index', 'UsersTypesController@index');
	Route::get('users_types/create', 'UsersTypesController@create');
	Route::post('users_types/store', 'UsersTypesController@store');
	Route::get('users_types/show/{user_type_uid}', 'UsersTypesController@show');
	Route::get('users_types/edit/{user_type_uid}', 'UsersTypesController@edit');
	Route::post('users_types/update/{user_type_uid}', 'UsersTypesController@update');
	Route::get('users_types/destroy/{user_type_uid}', 'UsersTypesController@destroy');
	/* users_positions */
	Route::match(['get', 'post'],'users_positions/index', 'UsersPositionsController@index');
	Route::get('users_positions/create', 'UsersPositionsController@create');
	Route::post('users_positions/store', 'UsersPositionsController@store');
	Route::get('users_positions/show/{user_position_uid}', 'UsersPositionsController@show');
	Route::get('users_positions/edit/{user_position_uid}', 'UsersPositionsController@edit');
	Route::post('users_positions/update/{user_position_uid}', 'UsersPositionsController@update');
	Route::get('users_positions/destroy/{user_position_uid}', 'UsersPositionsController@destroy');
	/* users_divisions */
	Route::match(['get', 'post'],'users_divisions/index', 'UsersDivisionsController@index');
	Route::get('users_divisions/create', 'UsersDivisionsController@create');
	Route::post('users_divisions/store', 'UsersDivisionsController@store');
	Route::get('users_divisions/show/{user_division_uid}', 'UsersDivisionsController@show');
	Route::get('users_divisions/edit/{user_division_uid}', 'UsersDivisionsController@edit');
	Route::post('users_divisions/update/{user_division_uid}', 'UsersDivisionsController@update');
	Route::get('users_divisions/destroy/{user_division_uid}', 'UsersDivisionsController@destroy');
	/* vehicles */
	Route::match(['get', 'post'],'vehicles/index', 'VehiclesController@index');
	Route::get('vehicles/create', 'VehiclesController@create');
	Route::post('vehicles/store', 'VehiclesController@store');
	Route::get('vehicles/show/{vehicle_uid}', 'VehiclesController@show');
	Route::get('vehicles/edit/{vehicle_uid}', 'VehiclesController@edit');
	Route::post('vehicles/update/{vehicle_uid}', 'VehiclesController@update');
	Route::get('vehicles/destroy/{vehicle_uid}', 'VehiclesController@destroy');
	Route::get('vehicles/getbrands/{vehicle_type_uid}', 'VehiclesController@getbrands');
	Route::get('vehicles/getmodels/{vehicle_brand_uid}', 'VehiclesController@getmodels');
	/* vehicles_brands */
	Route::match(['get', 'post'],'vehicles_brands/index', 'VehiclesBrandsController@index');
	Route::get('vehicles_brands/create', 'VehiclesBrandsController@create');
	Route::post('vehicles_brands/store', 'VehiclesBrandsController@store');
	Route::get('vehicles_brands/show/{vehicle_brand_uid}', 'VehiclesBrandsController@show');
	Route::get('vehicles_brands/edit/{vehicle_brand_uid}', 'VehiclesBrandsController@edit');
	Route::post('vehicles_brands/update/{vehicle_brand_uid}', 'VehiclesBrandsController@update');
	Route::get('vehicles_brands/destroy/{vehicle_brand_uid}', 'VehiclesBrandsController@destroy');
	/* vehicles_models */
	Route::match(['get', 'post'],'vehicles_models/index', 'VehiclesModelsController@index');
	Route::get('vehicles_models/create', 'VehiclesModelsController@create');
	Route::post('vehicles_models/store', 'VehiclesModelsController@store');
	Route::get('vehicles_models/show/{vehicle_model_uid}', 'VehiclesModelsController@show');
	Route::get('vehicles_models/edit/{vehicle_model_uid}', 'VehiclesModelsController@edit');
	Route::post('vehicles_models/update/{vehicle_model_uid}', 'VehiclesModelsController@update');
	Route::get('vehicles_models/destroy/{vehicle_model_uid}', 'VehiclesModelsController@destroy');
	Route::get('vehicles_models/getbrands/{vehicle_type_uid}', 'VehiclesModelsController@getbrands');
	/* vehicles_types */
	Route::match(['get', 'post'],'vehicles_types/index', 'VehiclesTypesController@index');
	Route::get('vehicles_types/create', 'VehiclesTypesController@create');
	Route::post('vehicles_types/store', 'VehiclesTypesController@store');
	Route::get('vehicles_types/show/{vehicle_type_uid}', 'VehiclesTypesController@show');
	Route::get('vehicles_types/edit/{vehicle_type_uid}', 'VehiclesTypesController@edit');
	Route::post('vehicles_types/update/{vehicle_type_uid}', 'VehiclesTypesController@update');
	Route::get('vehicles_types/destroy/{vehicle_type_uid}', 'VehiclesTypesController@destroy');
	/* vehicles_colors */
	Route::match(['get', 'post'],'vehicles_colors/index', 'VehiclesColorsController@index');
	Route::get('vehicles_colors/create', 'VehiclesColorsController@create');
	Route::post('vehicles_colors/store', 'VehiclesColorsController@store');
	Route::get('vehicles_colors/show/{vehicle_color_uid}', 'VehiclesColorsController@show');
	Route::get('vehicles_colors/edit/{vehicle_color_uid}', 'VehiclesColorsController@edit');
	Route::post('vehicles_colors/update/{vehicle_color_uid}', 'VehiclesColorsController@update');
	Route::get('vehicles_colors/destroy/{vehicle_color_uid}', 'VehiclesColorsController@destroy');
	/* parkings_sections */
	Route::match(['get', 'post'],'parkings_sections/index', 'ParkingsSectionsController@index');
	Route::get('parkings_sections/create', 'ParkingsSectionsController@create');
	Route::post('parkings_sections/store', 'ParkingsSectionsController@store');
	Route::get('parkings_sections/show/{parking_section_uid}', 'ParkingsSectionsController@show');
	Route::get('parkings_sections/edit/{parking_section_uid}', 'ParkingsSectionsController@edit');
	Route::post('parkings_sections/update/{parking_section_uid}', 'ParkingsSectionsController@update');
	Route::get('parkings_sections/destroy/{parking_section_uid}', 'ParkingsSectionsController@destroy');
	/* parkings_dimensions */
	Route::match(['get', 'post'],'parkings_dimensions/index', 'ParkingsDimensionsController@index');
	Route::get('parkings_dimensions/create', 'ParkingsDimensionsController@create');
	Route::post('parkings_dimensions/store', 'ParkingsDimensionsController@store');
	Route::get('parkings_dimensions/show/{parking_dimension_uid}', 'ParkingsDimensionsController@show');
	Route::get('parkings_dimensions/edit/{parking_dimension_uid}', 'ParkingsDimensionsController@edit');
	Route::post('parkings_dimensions/update/{parking_dimension_uid}', 'ParkingsDimensionsController@update');
	Route::get('parkings_dimensions/destroy/{parking_dimension_uid}', 'ParkingsDimensionsController@destroy');
	/* parkings */
	Route::match(['get', 'post'],'parkings/index', 'ParkingsController@index');
	Route::get('parkings/create', 'ParkingsController@create');
	Route::post('parkings/store', 'ParkingsController@store');
	Route::get('parkings/show/{parking_uid}', 'ParkingsController@show');
	Route::get('parkings/edit/{parking_uid}', 'ParkingsController@edit');
	Route::post('parkings/update/{parking_uid}', 'ParkingsController@update');
	Route::get('parkings/destroy/{parking_uid}', 'ParkingsController@destroy');
	/* parkings_lot */
	Route::get('parkings_lot/create', 'ParkingsLotController@create');
	Route::post('parkings_lot/store', 'ParkingsLotController@store');
	/* booking */
	Route::match(['get', 'post'],'booking/index', 'BookingController@index');
	Route::post('booking/store', 'BookingController@store');
	Route::post('booking/update', 'BookingController@update');
	Route::post('booking/destroy', 'BookingController@destroy');
	Route::get('booking/getvehicles/{user_number_id}/{booking_date}', 'BookingController@getvehicles');
	/* booking_date */
	Route::match(['get', 'post'], 'booking_date/index', 'BookingDateController@index');
	Route::post('booking_date/store', 'BookingDateController@store');
	Route::get('booking_date/store_test', 'BookingDateController@store_test');
	Route::post('booking_date/update', 'BookingDateController@update');
	Route::post('booking_date/destroy', 'BookingDateController@destroy');
	Route::get('booking_date/getvehicles/{user_number_id}/{booking_date}', 'BookingDateController@getvehicles');
	/* rewards */
	Route::match(['get', 'post'],'rewards/index', 'RewardsController@index');
	Route::get('rewards/create', 'RewardsController@create');
	Route::post('rewards/store', 'RewardsController@store');
	Route::get('rewards/show/{reward_uid}', 'RewardsController@show');
	Route::get('rewards/edit/{reward_uid}', 'RewardsController@edit');
	Route::post('rewards/update/{reward_uid}', 'RewardsController@update');
	Route::get('rewards/destroy/{reward_uid}', 'RewardsController@destroy');
	/* tests */
	Route::match(['get', 'post'],'tests/index', 'TestsController@index');
	Route::get('tests/create', 'TestsController@create');
	Route::post('tests/store', 'TestsController@store');
	Route::get('tests/show/{test_uid}', 'TestsController@show');
	Route::get('tests/edit/{test_uid}', 'TestsController@edit');
	Route::post('tests/update/{test_uid}', 'TestsController@update');
	Route::get('tests/destroy/{test_uid}', 'TestsController@destroy');
	/* tests_report */
	Route::match(['get', 'post'],'tests_report/index', 'TestsReportController@index');
	Route::get('tests_report/show/{month_first}/{month_last}/{test_uid}', 'TestsReportController@show');
});