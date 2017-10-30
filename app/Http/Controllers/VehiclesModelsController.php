<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VehicleType;
use App\VehicleBrand;
use App\VehicleModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

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
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_models/index';
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
            ->join('vehicles_brands', 'vehicles_brands.vehicle_brand_uid', '=', 'vehicles_models.vehicle_brand_uid')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'vehicles_brands.vehicle_type_uid')
            ->where('vehicles_types.vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_brands.vehicle_brand_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_models.vehicle_model_name', 'like', '%'.$search.'%')
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
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_models/index';
        # View
        $data['vehicles_types'] = VehicleType::get();
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
            'vehicle_type_uid' => 'required',
            'vehicle_brand_uid' => 'required',
            'vehicle_model_name' => 'required|max:60|unique:vehicles_models,vehicle_model_name',
        ]);
        # Request
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $vehicle_brand_uid = $request->input('vehicle_brand_uid');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_model_description = $request->input('vehicle_model_description');
        $vehicle_model_uid = Uuid::generate()->string;
        # Insert
        $vehicle_model = New VehicleModel;
        $vehicle_model->vehicle_brand_uid = $vehicle_brand_uid;
        $vehicle_model->vehicle_model_name = $vehicle_model_name;
        $vehicle_model->vehicle_model_description = $vehicle_model_description;
        $vehicle_model->vehicle_model_uid = $vehicle_model_uid;
        $vehicle_model->save();                
        return redirect('vehicles_models/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_model_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_models/index';
        # View
        $count = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->first();
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
    public function edit($vehicle_model_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_models/index';
        # View
        $count = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->count();
        if ($count>0) {
            # Edit
            $data['vehicles_types'] = VehicleType::get();
            $data['row'] = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->first();
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
    public function update(Request $request, $vehicle_model_uid)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_uid' => 'required',
            'vehicle_brand_uid' => 'required',
            'vehicle_model_name' => 'required|max:60',
        ]);
        # Request
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $vehicle_brand_uid = $request->input('vehicle_brand_uid');
        $vehicle_model_name = $request->input('vehicle_model_name');
        $vehicle_model_description = $request->input('vehicle_model_description');
        $vehicle_model_uid = $request->input('vehicle_model_uid');
        # Unique 
        $count = VehicleModel::where('vehicle_model_name', $vehicle_model_name)->where('vehicle_model_uid', '<>', $vehicle_model_uid)->count();
        if ($count<1) {
            # Update
            $vehicle_model = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->first();
            $vehicle_model->vehicle_brand_uid = $vehicle_brand_uid;
            $vehicle_model->vehicle_model_name = $vehicle_model_name;
            $vehicle_model->vehicle_model_description = $vehicle_model_description;
            $vehicle_model->vehicle_model_uid = $vehicle_model_uid;
            $vehicle_model->save();                
            return redirect('vehicles_models/edit/'.$vehicle_model_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_models/edit/'.$vehicle_model_uid)->with('danger', 'El elemento modelo ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_model_uid)
    {
        $count = VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->count();
        if ($count>0) {
            # Delete
            VehicleModel::where('vehicle_model_uid', $vehicle_model_uid)->delete();
            return redirect('vehicles_models/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_models/index')->with('info', 'No se puede Eliminar el registro');
        }
    }

    public function getbrands(Request $request, $vehicle_type_uid)
    {
        $data['rows'] = VehicleBrand::where('vehicle_type_uid', $vehicle_type_uid)->get();
        return response()->json($data['rows']);
    }
}
