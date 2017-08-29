<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class VehiclesController extends Controller
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
    public function index(Request $request)
    {
        # User
        $data['user'] = Auth::user();
        # Request
        $method = $request->method();
        $search = $request->input('search');
        if ($request->isMethod('post')) {
            $request->session()->flash('search', $search);
            $request->session()->flash('info', 'Resultado de la busqueda: '.$search );
        }else{
            $request->session()->forget('info');
            $request->session()->forget('search');
        }
        $data['rows'] = DB::table('vehicles')
            ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
            ->join('vehicles_colors', 'vehicles_colors.vehicle_color_name', '=', 'vehicles.vehicle_color_name')
            ->join('vehicles_models', 'vehicles_models.vehicle_model_name', '=', 'vehicles.vehicle_model_name')
            ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles_models.vehicle_brand_name')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
            ->where('vehicles.vehicle_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles.vehicle_code', 'like', '%'.$search.'%')
            ->orWhere('vehicles.vehicle_year', 'like', '%'.$search.'%')
            ->orWhere('vehicles_types.vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_brands.vehicle_brand_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_models.vehicle_model_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_colors.vehicle_color_name', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('vehicles.index', ['data' => $data]);
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
        $data['vehicles_types'] = DB::table('vehicles_types')->get();
        $data['users'] = DB::table('users')->get();
        return view('vehicles.create', ['data' => $data]);
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
            'vehicle_type_name' => 'required',
            'vehicle_brand_name' => 'required|max:60|unique:vehicles,vehicle_brand_name',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        if ($request->hasFile('vehicle_brand_logo')) {
            $extension = $request->file('vehicle_brand_logo')->extension();
            $vehicle_brand_logo = $vehicle_brand_name.'.'.$extension;
            $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
            # Insert
            DB::table('vehicles')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_brand_description' => $vehicle_brand_description,
                    'vehicle_brand_logo' => $vehicle_brand_logo,
                ]
            );
        }else{
            # Insert
            DB::table('vehicles')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_brand_description' => $vehicle_brand_description,
                ]
            );
        }
        return redirect('vehicles/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_brand_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles')->where('vehicle_brand_id', '=', $vehicle_brand_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('vehicles')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles.vehicle_type_name')
                ->where('vehicle_brand_id', '=', $vehicle_brand_id)
                ->first();
            return view('vehicles.show', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_brand_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles')->where('vehicle_brand_id', '=', $vehicle_brand_id)->count();
        if ($count>0) {
            # Edit 
            $data['vehicles_types'] = DB::table('vehicles_types')->get();
            $data['row'] = DB::table('vehicles')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles.vehicle_type_name')
                ->where('vehicle_brand_id', '=', $vehicle_brand_id)
                ->first();
            return view('vehicles.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_brand_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_name' => 'required',
            'vehicle_brand_name' => 'required|max:60',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_brand_id = $request->input('vehicle_brand_id');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        # Unique 
        $count = DB::table('vehicles')->where('vehicle_brand_name', $vehicle_brand_name)->where('vehicle_brand_id', '<>', $vehicle_brand_id)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_brand_logo')) {
                $extension = $request->file('vehicle_brand_logo')->extension();
                $vehicle_brand_logo = $vehicle_brand_name.'.'.$extension;
                $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
                # Update
                DB::table('vehicles')
                    ->where('vehicle_brand_id', $vehicle_brand_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_brand_description' => $vehicle_brand_description,
                            'vehicle_brand_logo' => $vehicle_brand_logo,
                        ]
                    );
            }else{
                # Update
                DB::table('vehicles')
                    ->where('vehicle_brand_id', $vehicle_brand_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_brand_description' => $vehicle_brand_description,
                        ]
                    );
            }
            return redirect('vehicles/edit/'.$vehicle_brand_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles/edit/'.$vehicle_brand_id)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_brand_id)
    {
        $count = DB::table('vehicles')->where('vehicle_brand_id', '=', $vehicle_brand_id)->count();
        if ($count>0) {
            # Delete
            $data = DB::table('vehicles')->where('vehicle_brand_id', '=', $vehicle_brand_id)->first();
            Storage::delete($data->vehicle_brand_logo);
            DB::table('vehicles')->where('vehicle_brand_id', '=', $vehicle_brand_id)->delete();
            return redirect('vehicles/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles/index')->with('info', 'No se puede Eliminar el registro');
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
