<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

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
        $data = DB::table('vehicles_types')
            ->where('vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('vehicle_type_description', 'like', '%'.$search.'%')
            ->paginate(30);
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
        return view('vehicles_types.create');
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
        if ($request->hasFile('vehicle_type_icon')) {
            $extension = $request->file('vehicle_type_icon')->extension();
            $vehicle_type_icon = $vehicle_type_name.'.'.$extension;
            $request->vehicle_type_icon->storeAs('public', $vehicle_type_icon);
            # Insert
            DB::table('vehicles_types')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_type_description' => $vehicle_type_description,
                    'vehicle_type_icon' => $vehicle_type_icon,
                ]
            );
        }else{
            # Insert
            DB::table('vehicles_types')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'vehicle_type_description' => $vehicle_type_description,
                ]
            );
        }
        return redirect('vehicles_types/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_type_id)
    {
        $count = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->count();
        if ($count>0) {
            $data = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->first();
            return view('vehicles_types.show', ['data' => $data]);
        }else{
            return redirect('vehicles_types/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_type_id)
    {
        $count = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->count();
        if ($count>0) {
            $data = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->first();
            return view('vehicles_types.edit', ['data' => $data]);
        }else{
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
    public function update(Request $request, $vehicle_type_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_name' => 'required|max:60',
            'vehicle_type_icon' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_id = $request->input('vehicle_type_id');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $vehicle_type_description = $request->input('vehicle_type_description');
        # Unique 
        $count = DB::table('vehicles_types')->where('vehicle_type_name', $vehicle_type_name)->where('vehicle_type_id', '<>', $vehicle_type_id)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_type_icon')) {
                $extension = $request->file('vehicle_type_icon')->extension();
                $vehicle_type_icon = $vehicle_type_name.'.'.$extension;
                $request->vehicle_type_icon->storeAs('public', $vehicle_type_icon);
                # Update
                DB::table('vehicles_types')
                    ->where('vehicle_type_id', $vehicle_type_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_type_description' => $vehicle_type_description,
                            'vehicle_type_icon' => $vehicle_type_icon,
                        ]
                    );
            }else{
                # Update
                DB::table('vehicles_types')
                    ->where('vehicle_type_id', $vehicle_type_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'vehicle_type_description' => $vehicle_type_description,
                        ]
                    );
            }
            return redirect('vehicles_types/edit/'.$vehicle_type_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_types/edit/'.$vehicle_type_id)->with('danger', 'El elemento tipo ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_type_id)
    {
        $count = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->count();
        if ($count>0) {
            # Delete
            $data = DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->first();
            Storage::delete($data->vehicle_type_icon);
            DB::table('vehicles_types')->where('vehicle_type_id', '=', $vehicle_type_id)->delete();
            return redirect('vehicles_types/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('vehicles_types/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
