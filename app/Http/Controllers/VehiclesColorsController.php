<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $data['rows'] = DB::table('vehicles_colors')
            ->where('vehicles_colors.vehicle_color_name', 'like', '%'.$search.'%')
            ->paginate(30);
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
        # Insert
        DB::table('vehicles_colors')->insert(
            [
                'vehicle_color_name' => $vehicle_color_name,
            ]
        );
        return redirect('vehicles_colors/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_color_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles_colors')->where('vehicle_color_id', '=', $vehicle_color_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('vehicles_colors')
                ->where('vehicle_color_id', '=', $vehicle_color_id)
                ->first();
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
    public function edit($vehicle_color_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('vehicles_colors')->where('vehicle_color_id', '=', $vehicle_color_id)->count();
        if ($count>0) {
            # Edit
            $data['row'] = DB::table('vehicles_colors')
                ->where('vehicle_color_id', '=', $vehicle_color_id)
                ->first();
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
    public function update(Request $request, $vehicle_color_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_color_name' => 'required|max:60',
        ]);
        # Request
        $vehicle_color_id = $request->input('vehicle_color_id');
        $vehicle_color_name = $request->input('vehicle_color_name');
        # Unique 
        $count = DB::table('vehicles_colors')->where('vehicle_color_name', $vehicle_color_name)->where('vehicle_color_id', '<>', $vehicle_color_id)->count();
        if ($count<1) {
            # Update
            DB::table('vehicles_colors')
                ->where('vehicle_color_id', $vehicle_color_id)
                ->update(
                    [
                        'vehicle_color_name' => $vehicle_color_name,
                    ]
                );
            return redirect('vehicles_colors/edit/'.$vehicle_color_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_colors/edit/'.$vehicle_color_id)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_color_id)
    {
        $count = DB::table('vehicles_colors')->where('vehicle_color_id', '=', $vehicle_color_id)->count();
        if ($count>0) {
            # Delete
            DB::table('vehicles_colors')->where('vehicle_color_id', '=', $vehicle_color_id)->delete();
            return redirect('vehicles_colors/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_colors/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
