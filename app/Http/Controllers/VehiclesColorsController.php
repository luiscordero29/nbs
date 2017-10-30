<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VehicleColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class VehiclesColorsController extends Controller
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
        $data['subitem'] = 'vehicles_colors/index';
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
        $data['rows'] = VehicleColor::where('vehicle_color_name', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('vehicles_colors.index', ['data' => $data]);
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
        $data['subitem'] = 'vehicles_colors/index';
        # View
        return view('vehicles_colors.create', ['data' => $data]);
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
            'vehicle_color_name' => 'required|max:60|unique:vehicles_colors,vehicle_color_name',
        ]);
        # Request
        $vehicle_color_name = $request->input('vehicle_color_name');
        $vehicle_color_uid = Uuid::generate()->string;        
        # Insert
        $vehicle_color = New VehicleColor;
        $vehicle_color->vehicle_color_name = $vehicle_color_name;
        $vehicle_color->vehicle_color_uid = $vehicle_color_uid;
        $vehicle_color->save();
        # Return
        return redirect('vehicles_colors/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_color_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_colors/index';
        $count = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->first();
            return view('vehicles_colors.show', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_colors/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_color_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_colors/index';
        $count = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->first();
            return view('vehicles_colors.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_colors/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_color_uid)
    {
        # Rules
        $this->validate($request, [
            'vehicle_color_name' => 'required|max:60',
        ]);
        # Request
        $vehicle_color_uid = $request->input('vehicle_color_uid');
        $vehicle_color_name = $request->input('vehicle_color_name');
        # Unique 
        $count = VehicleColor::where('vehicle_color_name', $vehicle_color_name)->where('vehicle_color_uid', '<>', $vehicle_color_uid)->count();
        if ($count<1) {
            # Update
            $vehicle_color = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->first();
            $vehicle_color->vehicle_color_name = $vehicle_color_name;
            $vehicle_color->save();
            return redirect('vehicles_colors/edit/'.$vehicle_color_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_colors/edit/'.$vehicle_color_uid)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_color_uid)
    {
        $count = VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->count();
        if ($count>0) {
            # Delete
            VehicleColor::where('vehicle_color_uid', $vehicle_color_uid)->delete();
            return redirect('vehicles_colors/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_colors/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
