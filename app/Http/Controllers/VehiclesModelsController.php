<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class VehiclesModelsController extends Controller
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
        $data['rows'] = DB::table('vehicles_models')
            ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles_models.vehicle_brand_name')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
            ->where('vehicles_brands.vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_models.vehicle_brand_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_models.vehicle_model_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_models.vehicle_model_description', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('vehicles_models.index', ['data' => $data]);
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
        $data['vehicles_brands'] = 
            DB::table('vehicles_brands')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
                ->get();
        return view('vehicles_models.create', ['data' => $data]);
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
            'vehicle_brand_name' => 'required',
            'vehicle_model_name' => 'required|max:60|unique:vehicles_models,vehicle_model_name',
        ]);
        # Request
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_model_description = $request->input('vehicle_model_description');
        # Insert
        DB::table('vehicles_models')->insert(
            [
                'vehicle_brand_name' => $vehicle_brand_name,
                'vehicle_model_name' => $vehicle_model_name,
                'vehicle_model_description' => $vehicle_model_description,
            ]
        );
        return redirect('vehicles_models/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_model_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles_models')->where('vehicle_model_id', '=', $vehicle_model_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('vehicles_models')
                ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles_models.vehicle_brand_name')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
                ->where('vehicle_model_id', '=', $vehicle_model_id)->first();
            return view('vehicles_models.show', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_models/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_model_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles_models')->where('vehicle_model_id', '=', $vehicle_model_id)->count();
        if ($count>0) {
            # Edit
            $data['vehicles_brands'] = 
                DB::table('vehicles_brands')
                    ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
                    ->get();
            $data['row'] = DB::table('vehicles_models')
                ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_name', '=', 'vehicles_models.vehicle_brand_name')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'vehicles_brands.vehicle_type_name')
                ->where('vehicle_model_id', '=', $vehicle_model_id)->first();
            return view('vehicles_models.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_models/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_model_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_brand_name' => 'required',
            'vehicle_model_name' => 'required|max:60',
        ]);
        # Request
        $vehicle_model_id = $request->input('vehicle_model_id');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_model_description = $request->input('vehicle_model_description');
        # Unique 
        $count = DB::table('vehicles_models')->where('vehicle_model_name', $vehicle_model_name)->where('vehicle_model_id', '<>', $vehicle_model_id)->count();
        if ($count<1) {
            # Update
            DB::table('vehicles_models')
                ->where('vehicle_model_id', $vehicle_model_id)
                ->update(
                    [
                        'vehicle_brand_name' => $vehicle_brand_name,
                        'vehicle_model_name' => $vehicle_model_name,
                        'vehicle_model_description' => $vehicle_model_description,
                    ]
                );
            return redirect('vehicles_models/edit/'.$vehicle_model_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_models/edit/'.$vehicle_model_id)->with('danger', 'El elemento modelo ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_model_id)
    {
        $count = DB::table('vehicles_models')->where('vehicle_model_id', '=', $vehicle_model_id)->count();
        if ($count>0) {
            # Delete
            DB::table('vehicles_models')->where('vehicle_model_id', '=', $vehicle_model_id)->delete();
            return redirect('vehicles_models/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_models/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
