<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Vehicle;
use App\VehicleType;
use App\VehicleBrand;
use App\VehicleModel;
use App\VehicleColor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class UsersVehiclesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        # Request
        $method = $request->method();
        $search = $request->input('search');
        if ($request->isMethod('post')) {
            $data['search'] = $request->input('search');
            $request->session()->flash('search', $search);
            $request->session()->flash('info', 'Resultado de la busqueda: '.$search );
        }else{
            $data['search'] = '';
            $request->session()->forget('info');
            $request->session()->forget('search');
        }
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            $data['row'] = User::where('user_uid', $user_uid)->first();
            $data['rows'] = DB::table('vehicles')
                ->join('users', 'users.user_uid', '=', 'vehicles.user_uid')
                ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_uid', '=', 'vehicles.vehicle_color_uid')
                ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_uid', '=', 'vehicles.vehicle_model_uid')
                ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_uid', '=', 'vehicles.vehicle_brand_uid')
                ->leftJoin('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'vehicles.vehicle_type_uid')
                ->where('users.user_uid', $user_uid)
                ->where(function ($query) use ($data)  {
                    $query->where('vehicles.vehicle_code', 'like', '%'.$data['search'].'%')
                        ->orWhere('vehicles_types.vehicle_type_name', 'like', '%'.$data['search'].'%');
                })
                ->paginate(30);
            # View
            return view('users_vehicles.index', ['data' => $data]);
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # View 
            $data['row'] = User::where('user_uid', $user_uid)->first();
            $data['vehicles_colors'] = VehicleColor::get();
            $data['vehicles_types'] = VehicleType::get();
            return view('users_vehicles.create', ['data' => $data]);
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_uid)
    {
        $count = DB::table('users')->where('user_uid', '=', $user_uid)->count();
        if ($count>0) {
            # Rules
            $this->validate($request, [
                'user_uid' => 'required',
                'vehicle_type_uid' => 'required',
                'vehicle_name' => 'max:60',
                'vehicle_status' => 'required',
                'vehicle_code' => 'required|max:8|unique:vehicles,vehicle_code',
                'vehicle_image' => 'image|mimes:jpeg,png',
            ]);
            # Request
            $vehicle_uid = Uuid::generate()->string;        
            $user_uid = $request->input('user_uid');
            $vehicle_type_uid = $request->input('vehicle_type_uid');
            $vehicle_brand_uid = $request->input('vehicle_brand_uid');
            $vehicle_model_uid = $request->input('vehicle_model_uid');
            $vehicle_color_uid = $request->input('vehicle_color_uid');        
            $vehicle_name = $request->input('vehicle_name');
            $vehicle_status = $request->input('vehicle_status');
            $vehicle_code = $request->input('vehicle_code');
            $vehicle_year = $request->input('vehicle_year');
            if ($request->hasFile('vehicle_image')) {
                $extension = $request->file('vehicle_image')->extension();
                $vehicle_image = $vehicle_uid.'.'.$extension;
                $request->vehicle_image->storeAs('public', $vehicle_image);
                # Insert
                $vehicle = New Vehicle;
                $vehicle->vehicle_uid = $vehicle_uid;
                $vehicle->user_uid = $user_uid;
                $vehicle->vehicle_type_uid = $vehicle_type_uid;
                $vehicle->vehicle_model_uid = $vehicle_model_uid;
                $vehicle->vehicle_brand_uid = $vehicle_brand_uid;
                $vehicle->vehicle_color_uid = $vehicle_color_uid;
                $vehicle->vehicle_name = $vehicle_name;
                $vehicle->vehicle_code = $vehicle_code;
                $vehicle->vehicle_status = $vehicle_status;
                $vehicle->vehicle_year = $vehicle_year;
                $vehicle->vehicle_image = $vehicle_image;
                $vehicle->save();
            }else{
                # Insert
                $vehicle = New Vehicle;
                $vehicle->vehicle_uid = $vehicle_uid;
                $vehicle->user_uid = $user_uid;
                $vehicle->vehicle_type_uid = $vehicle_type_uid;
                $vehicle->vehicle_model_uid = $vehicle_model_uid;
                $vehicle->vehicle_brand_uid = $vehicle_brand_uid;
                $vehicle->vehicle_color_uid = $vehicle_color_uid;
                $vehicle->vehicle_name = $vehicle_name;
                $vehicle->vehicle_code = $vehicle_code;
                $vehicle->vehicle_status = $vehicle_status;
                $vehicle->vehicle_year = $vehicle_year;
                $vehicle->save();
            }
            return redirect('users_vehicles/create/'.$user_uid)->with('success', 'Registro Guardado');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_uid, $vehicle_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            $count = Vehicle::where('vehicle_uid', $vehicle_uid)->count();
            if ($count>0) {
                # Show
                $data['row'] = DB::table('vehicles')
                ->join('users', 'users.user_uid', '=', 'vehicles.user_uid')
                ->leftJoin('users_types', 'users_types.user_type_uid', '=', 'users.user_type_uid')
                ->leftJoin('users_divisions', 'users_divisions.user_division_uid', '=', 'users.user_division_uid')
                ->leftJoin('users_positions', 'users_positions.user_position_uid', '=', 'users.user_position_uid')
                ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_uid', '=', 'vehicles.vehicle_color_uid')
                ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_uid', '=', 'vehicles.vehicle_model_uid')
                ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_uid', '=', 'vehicles.vehicle_brand_uid')
                ->leftJoin('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'vehicles.vehicle_type_uid')
                ->where('vehicle_uid', $vehicle_uid)
                ->first();
                return view('users_vehicles.show', ['data' => $data]);
            }else{
                # Error
                return redirect('users_vehicles/index/'.$user_uid)->with('info', 'No se puede Ver el registro');
            }
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_uid, $vehicle_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            $count = Vehicle::where('vehicle_uid', $vehicle_uid)->count();
            if ($count>0) {
                # Edit 
                $data['vehicles_colors'] = VehicleColor::get();
                $data['vehicles_types'] = VehicleType::get();
                $data['users'] = User::get();
                $data['row'] = DB::table('vehicles')
                ->join('users', 'users.user_uid', '=', 'vehicles.user_uid')
                ->leftJoin('users_types', 'users_types.user_type_uid', '=', 'users.user_type_uid')
                ->leftJoin('users_divisions', 'users_divisions.user_division_uid', '=', 'users.user_division_uid')
                ->leftJoin('users_positions', 'users_positions.user_position_uid', '=', 'users.user_position_uid')
                ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_uid', '=', 'vehicles.vehicle_color_uid')
                ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_uid', '=', 'vehicles.vehicle_model_uid')
                ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_uid', '=', 'vehicles.vehicle_brand_uid')
                ->leftJoin('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'vehicles.vehicle_type_uid')
                ->where('vehicle_uid', $vehicle_uid)
                ->first();
                $data['vehicles_brands'] = VehicleBrand::where('vehicle_type_uid', $data['row']->vehicle_type_uid)->get();
                $data['vehicles_models'] = VehicleModel::where('vehicle_brand_uid', $data['row']->vehicle_brand_uid)->get();
                return view('users_vehicles.edit', ['data' => $data]);
            }else{
                # Error
                return redirect('users_vehicles/index/'.$user_uid)->with('info', 'No se puede Editar el registro');
            }
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_uid, $vehicle_uid)
    {
        $count = DB::table('users')->where('user_uid', '=', $user_uid)->count();
        if ($count>0) {
            # Rules
            $this->validate($request, [
                'user_uid' => 'required',
                'vehicle_type_uid' => 'required',
                'vehicle_name' => 'max:60',
                'vehicle_status' => 'required',
                'vehicle_code' => 'required|max:8',
                'vehicle_image' => 'image|mimes:jpeg,png',
            ]);
            # Request
            $vehicle_uid = $request->input('vehicle_uid');        
            $user_uid = $request->input('user_uid');
            $vehicle_type_uid = $request->input('vehicle_type_uid');
            $vehicle_brand_uid = $request->input('vehicle_brand_uid');
            $vehicle_model_uid = $request->input('vehicle_model_uid');
            $vehicle_color_uid = $request->input('vehicle_color_uid');        
            $vehicle_name = $request->input('vehicle_name');
            $vehicle_status = $request->input('vehicle_status');
            $vehicle_code = $request->input('vehicle_code');
            $vehicle_year = $request->input('vehicle_year');
            # Unique 
            $count = Vehicle::where('vehicle_code', $vehicle_code)->where('vehicle_uid', '<>', $vehicle_uid)->count();
            if ($count<1) {
                if ($request->hasFile('vehicle_image')) {
                    $extension = $request->file('vehicle_image')->extension();
                    $vehicle_image = $vehicle_uid.'.'.$extension;
                    $request->vehicle_image->storeAs('public', $vehicle_image);
                    # Update
                    $vehicle = Vehicle::where('vehicle_uid', $vehicle_uid)->first();
                    $vehicle->vehicle_uid = $vehicle_uid;
                    $vehicle->user_uid = $user_uid;
                    $vehicle->vehicle_type_uid = $vehicle_type_uid;
                    $vehicle->vehicle_model_uid = $vehicle_model_uid;
                    $vehicle->vehicle_brand_uid = $vehicle_brand_uid;
                    $vehicle->vehicle_color_uid = $vehicle_color_uid;
                    $vehicle->vehicle_name = $vehicle_name;
                    $vehicle->vehicle_code = $vehicle_code;
                    $vehicle->vehicle_status = $vehicle_status;
                    $vehicle->vehicle_year = $vehicle_year;
                    $vehicle->vehicle_image = $vehicle_image;
                    $vehicle->save();
                }else{
                    # Update
                    $vehicle = Vehicle::where('vehicle_uid', $vehicle_uid)->first();
                    $vehicle->vehicle_uid = $vehicle_uid;
                    $vehicle->user_uid = $user_uid;
                    $vehicle->vehicle_type_uid = $vehicle_type_uid;
                    $vehicle->vehicle_model_uid = $vehicle_model_uid;
                    $vehicle->vehicle_brand_uid = $vehicle_brand_uid;
                    $vehicle->vehicle_color_uid = $vehicle_color_uid;
                    $vehicle->vehicle_name = $vehicle_name;
                    $vehicle->vehicle_code = $vehicle_code;
                    $vehicle->vehicle_status = $vehicle_status;
                    $vehicle->vehicle_year = $vehicle_year;
                    $vehicle->save();
                }
                return redirect('users_vehicles/edit/'.$user_uid.'/'.$vehicle_uid)->with('success', 'Registro Actualizado');
            }else{
                # Error
                return redirect('users_vehicles/edit/'.$user_uid.'/'.$vehicle_uid)->with('danger', 'El elemento marca ya está en uso.');
            }
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_uid, $vehicle_uid)
    {
        $count = DB::table('users')->where('user_uid', '=', $user_uid)->count();
        if ($count>0) {
            $count = DB::table('vehicles')->where('vehicle_uid', '=', $vehicle_uid)->count();
            if ($count>0) {
                # Delete
                $data = DB::table('vehicles')->where('vehicle_uid', '=', $vehicle_uid)->first();
                Storage::delete($data->vehicle_image);
                DB::table('vehicles')->where('vehicle_uid', '=', $vehicle_uid)->delete();
                return redirect('users_vehicles/index/'.$user_uid)->with('success', 'Registro Elimino');
            }else{
                # Error
                return redirect('users_vehicles/index/'.$user_uid)->with('info', 'No se puede Eliminar el registro');
            }
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    public function getbrands(Request $request, $vehicle_type_uid)
    {
        $data['rows'] = VehicleBrand::where('vehicle_type_uid', $vehicle_type_uid)->get();
        return response()->json($data['rows']);
    }

    public function getmodels(Request $request, $vehicle_brand_uid)
    {
        $data['rows'] = VehicleModel::where('vehicle_brand_uid', $vehicle_brand_uid)->get();
        return response()->json($data['rows']);
    }
}
