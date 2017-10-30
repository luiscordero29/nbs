<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class VehiclesTypesController extends Controller
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
        $data['subitem'] = 'vehicles_types/index';
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
        $data['rows'] = VehicleType::where('vehicle_type_name', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('vehicles_types.index', ['data' => $data]);
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
        $data['subitem'] = 'vehicles_types/index';
        # View
        return view('vehicles_types.create', ['data' => $data]);
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
            'vehicle_type_name' => 'required|max:60|unique:vehicles_types,vehicle_type_name',
            'vehicle_type_icon' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_type_description = $request->input('vehicle_type_description');
        $vehicle_type_uid = Uuid::generate()->string;        
        if ($request->hasFile('vehicle_type_icon')) {
            $extension = $request->file('vehicle_type_icon')->extension();
            $vehicle_type_icon = $vehicle_type_uid.'.'.$extension;
            $request->vehicle_type_icon->storeAs('public', $vehicle_type_icon);
            # Insert
            $vehicle_type = New VehicleType;
            $vehicle_type->vehicle_type_name = $vehicle_type_name;
            $vehicle_type->vehicle_type_description = $vehicle_type_description;
            $vehicle_type->vehicle_type_icon = $vehicle_type_icon;
            $vehicle_type->vehicle_type_uid = $vehicle_type_uid;
            $vehicle_type->save();
        }else{
            $vehicle_type = New VehicleType;
            $vehicle_type->vehicle_type_name = $vehicle_type_name;
            $vehicle_type->vehicle_type_description = $vehicle_type_description;
            $vehicle_type->vehicle_type_uid = $vehicle_type_uid;
            $vehicle_type->save();
        }
        return redirect('vehicles_types/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_type_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_types/index';
        $count = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->first();
            return view('vehicles_types.show', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_types/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_type_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_types/index';
        $count = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->first();
            return view('vehicles_types.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_types/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_type_uid)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_name' => 'required|max:60',
            'vehicle_type_icon' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_type_description = $request->input('vehicle_type_description');
        # Unique 
        $count = VehicleType::where('vehicle_type_name', $vehicle_type_name)->where('vehicle_type_uid', '<>', $vehicle_type_uid)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_type_icon')) {
                $extension = $request->file('vehicle_type_icon')->extension();
                $vehicle_type_icon = $vehicle_type_name.'.'.$extension;
                $request->vehicle_type_icon->storeAs('public', $vehicle_type_icon);
                # Update
                $vehicle_type = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->first();
                $vehicle_type->vehicle_type_name = $vehicle_type_name;
                $vehicle_type->vehicle_type_description = $vehicle_type_description;
                $vehicle_type->vehicle_type_icon = $vehicle_type_icon;
                $vehicle_type->save();
            }else{
                # Update
                $vehicle_type = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->first();
                $vehicle_type->vehicle_type_name = $vehicle_type_name;
                $vehicle_type->vehicle_type_description = $vehicle_type_description;
                $vehicle_type->save();
            }
            return redirect('vehicles_types/edit/'.$vehicle_type_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_types/edit/'.$vehicle_type_uid)->with('danger', 'El elemento tipo ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_type_uid)
    {
        $count = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->count();
        if ($count>0) {
            # Delete
            $data = VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->first();
            Storage::delete($data->vehicle_type_icon);
            VehicleType::where('vehicle_type_uid', $vehicle_type_uid)->delete();
            return redirect('vehicles_types/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_types/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
