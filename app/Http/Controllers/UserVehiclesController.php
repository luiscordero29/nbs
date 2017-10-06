<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class UserVehiclesController extends Controller
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
    public function index()
    {
        # User
        $data['user'] = Auth::user();
        $data['rows'] = DB::table('vehicles')
            ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
            ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_name', '=', 'vehicles.vehicle_color_name')
            ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_name', '=', 'vehicles.vehicle_model_name')
            ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles.vehicle_brand_name')
            ->leftJoin('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles.vehicle_type_name')
            ->where('users.user_id', '=', $data['user']->user_id)
            ->paginate(30);
        # View
        return view('user_vehicles.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        # User
        $data['user'] = Auth::user();
        # View 
        $data['vehicles_colors'] = DB::table('vehicles_colors')->get();
        $data['vehicles_types'] = DB::table('vehicles_types')->get();
        return view('user_vehicles.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # Rules
        $this->validate($request, [
            'user_number_id' => 'required',
            'vehicle_status' => 'required',
            'vehicle_code' => 'required|max:8|unique:vehicles,vehicle_code',
            'vehicle_type_name' => 'required',
            'vehicle_name' => 'max:60',
            'vehicle_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $user_number_id = $request->input('user_number_id');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_name = $request->input('vehicle_name');
        $vehicle_color_name = $request->input('vehicle_color_name');
        $vehicle_status = $request->input('vehicle_status');
        $vehicle_code = $request->input('vehicle_code');
        $vehicle_year = $request->input('vehicle_year');
        if ($request->hasFile('vehicle_image')) {
            $extension = $request->file('vehicle_image')->extension();
            $vehicle_image = $vehicle_code.'.'.$extension;
            $request->vehicle_image->storeAs('public', $vehicle_image);
            # Insert
            DB::table('vehicles')->insert(
                [
                    'user_number_id' => $user_number_id,
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_model_name' => $vehicle_model_name,
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_name' => $vehicle_name,
                    'vehicle_code' => $vehicle_code,
                    'vehicle_color_name' => $vehicle_color_name,
                    'vehicle_status' => $vehicle_status,
                    'vehicle_year' => $vehicle_year,
                    'vehicle_image' => $vehicle_image,
                ]
            );
        }else{
            # Insert
            DB::table('vehicles')->insert(
                [
                    'user_number_id' => $user_number_id,
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_model_name' => $vehicle_model_name,
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_name' => $vehicle_name,
                    'vehicle_code' => $vehicle_code,
                    'vehicle_color_name' => $vehicle_color_name,
                    'vehicle_status' => $vehicle_status,
                    'vehicle_year' => $vehicle_year,
                ]
            );
        }
        return redirect('user_vehicles/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles')
            ->where('vehicle_id', '=', $vehicle_id)
            ->where('user_number_id', '=', $data['user']->user_number_id)
            ->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('vehicles')
                ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
                ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_name', '=', 'vehicles.vehicle_color_name')
                ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_name', '=', 'vehicles.vehicle_model_name')
                ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles.vehicle_brand_name')
                ->leftJoin('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles.vehicle_type_name')
                ->where('vehicles.vehicle_id', '=', $vehicle_id)
                ->where('users.user_number_id', '=', $data['user']->user_number_id)
                ->first();
            return view('user_vehicles.show', ['data' => $data]);
        }else{
            # Error
            return redirect('user_vehicles/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles')
            ->where('vehicle_id', '=', $vehicle_id)
            ->where('user_number_id', '=', $data['user']->user_number_id)
            ->count();
        if ($count>0) {
            # Edit 
            $data['vehicles_colors'] = DB::table('vehicles_colors')->get();
            $data['vehicles_types'] = DB::table('vehicles_types')->get();
            $data['users'] = DB::table('users')->get();
            $data['row'] = DB::table('vehicles')
                ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
                ->leftJoin('vehicles_colors', 'vehicles_colors.vehicle_color_name', '=', 'vehicles.vehicle_color_name')
                ->leftJoin('vehicles_models', 'vehicles_models.vehicle_model_name', '=', 'vehicles.vehicle_model_name')
                ->leftJoin('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles.vehicle_brand_name')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles.vehicle_type_name')
                ->where('vehicle_id', '=', $vehicle_id)
                ->first();
            $data['vehicles_brands'] = DB::table('vehicles_brands')->where('vehicle_type_name', $data['row']->vehicle_type_name)->get();
            $data['vehicles_models'] = DB::table('vehicles_models')->where('vehicle_brand_name', $data['row']->vehicle_brand_name)->get();
            return view('user_vehicles.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('user_vehicles/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_id)
    {
        # Rules
        $this->validate($request, [
            'user_number_id' => 'required',
            'vehicle_status' => 'required',
            'vehicle_code' => 'required|max:8',
            'vehicle_type_name' => 'required',
            'vehicle_name' => 'max:60',
            'vehicle_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_id = $request->input('vehicle_id');
        $user_number_id = $request->input('user_number_id');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_name = $request->input('vehicle_name');
        $vehicle_color_name = $request->input('vehicle_color_name');
        $vehicle_status = $request->input('vehicle_status');
        $vehicle_code = $request->input('vehicle_code');
        $vehicle_year = $request->input('vehicle_year');
        # Unique 
        $count = DB::table('vehicles')->where('vehicle_id', $vehicle_id)->where('vehicle_code', '<>', $vehicle_code)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_image')) {
                $extension = $request->file('vehicle_image')->extension();
                $vehicle_image = $vehicle_code.'.'.$extension;
                $request->vehicle_image->storeAs('public', $vehicle_image);
                # Update
                DB::table('vehicles')
                    ->where('vehicle_id', $vehicle_id)
                    ->update(
                        [
                            'user_number_id' => $user_number_id,
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_model_name' => $vehicle_model_name,
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_name' => $vehicle_name,
                            'vehicle_code' => $vehicle_code,
                            'vehicle_color_name' => $vehicle_color_name,
                            'vehicle_status' => $vehicle_status,
                            'vehicle_year' => $vehicle_year,
                            'vehicle_image' => $vehicle_image,
                        ]
                    );
            }else{
                # Update
                DB::table('vehicles')
                    ->where('vehicle_id', $vehicle_id)
                    ->update(
                        [
                            'user_number_id' => $user_number_id,
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_model_name' => $vehicle_model_name,
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_name' => $vehicle_name,
                            'vehicle_code' => $vehicle_code,
                            'vehicle_color_name' => $vehicle_color_name,
                            'vehicle_status' => $vehicle_status,
                            'vehicle_year' => $vehicle_year,
                        ]
                    );
            }
            return redirect('user_vehicles/edit/'.$vehicle_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('user_vehicles/edit/'.$vehicle_id)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles')
            ->where('vehicle_id', '=', $vehicle_id)
            ->where('user_number_id', '=', $data['user']->user_number_id)
            ->count();
        if ($count>0) {
            # Delete
            $data = DB::table('vehicles')->where('vehicle_id', '=', $vehicle_id)->first();
            Storage::delete($data->vehicle_image);
            DB::table('vehicles')->where('vehicle_id', '=', $vehicle_id)->delete();
            return redirect('user_vehicles/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('user_vehicles/index')->with('info', 'No se puede Eliminar el registro');
        }
    }

    public function getbrands(Request $request, $vehicle_type_name)
    {
        $data['rows'] = DB::table('vehicles_brands')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
            ->where('vehicles_brands.vehicle_type_name', $vehicle_type_name)
            ->get();
        return response()->json($data['rows']);
    }

    public function getmodels(Request $request, $vehicle_brand_name)
    {
        $data['rows'] = DB::table('vehicles_models')
            ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles_models.vehicle_brand_name')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
            ->where('vehicles_models.vehicle_brand_name', $vehicle_brand_name)
            ->get();
        return response()->json($data['rows']);
    }
}
