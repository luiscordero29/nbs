<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class ParkingsDimensionsController extends Controller
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
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_dimensions/index';
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
        $data['rows'] = DB::table('parkings_dimensions')
            ->where('parkings_dimensions.parking_dimension_name', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('parkings_dimensions.index', ['data' => $data]);
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
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_dimensions/index';
        # View 
        return view('parkings_dimensions.create', ['data' => $data]);
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
            'parking_dimension_name' => 'required|max:60|unique:parkings_dimensions,parking_dimension_name',
            'parking_dimension_size' => 'required|max:30',
            'parking_dimension_long' => 'required|numeric',
            'parking_dimension_height' => 'required|numeric',
            'parking_dimension_width' => 'required|numeric',
            'parking_dimension_icon' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $parking_dimension_name = $request->input('parking_dimension_name');
        $parking_dimension_size = $request->input('parking_dimension_size');
        $parking_dimension_long = $request->input('parking_dimension_long');
        $parking_dimension_height = $request->input('parking_dimension_height');
        $parking_dimension_width = $request->input('parking_dimension_width');
        if ($request->hasFile('parking_dimension_icon')) {
            $extension = $request->file('parking_dimension_icon')->extension();
            $parking_dimension_icon = $parking_dimension_name.'.'.$extension;
            $request->parking_dimension_icon->storeAs('public', $parking_dimension_icon);
            # Insert
            DB::table('parkings_dimensions')->insert(
                [
                    'parking_dimension_name' => $parking_dimension_name,
                    'parking_dimension_size' => $parking_dimension_size,
                    'parking_dimension_long' => $parking_dimension_long,
                    'parking_dimension_height' => $parking_dimension_height,
                    'parking_dimension_width' => $parking_dimension_width,
                    'parking_dimension_icon' => $parking_dimension_icon,
                ]
            );
        }else{
            # Insert
            DB::table('parkings_dimensions')->insert(
                [
                    'parking_dimension_name' => $parking_dimension_name,
                    'parking_dimension_size' => $parking_dimension_size,
                    'parking_dimension_long' => $parking_dimension_long,
                    'parking_dimension_height' => $parking_dimension_height,
                    'parking_dimension_width' => $parking_dimension_width,
                ]
            );
        }
        return redirect('parkings_dimensions/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parking_dimension_id)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_dimensions/index';
        $count = DB::table('parkings_dimensions')->where('parking_dimension_id', '=', $parking_dimension_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('parkings_dimensions')
                ->where('parking_dimension_id', '=', $parking_dimension_id)
                ->first();
            return view('parkings_dimensions.show', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings_dimensions/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($parking_dimension_id)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_dimensions/index';
        $count = DB::table('parkings_dimensions')->where('parking_dimension_id', '=', $parking_dimension_id)->count();
        if ($count>0) {
            # Edit 
            $data['vehicles_types'] = DB::table('vehicles_types')->get();
            $data['row'] = DB::table('parkings_dimensions')
                ->where('parking_dimension_id', '=', $parking_dimension_id)
                ->first();
            return view('parkings_dimensions.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings_dimensions/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parking_dimension_id)
    {
        # Rules
        $this->validate($request, [
            'parking_dimension_name' => 'required|max:60',
            'parking_dimension_size' => 'required|max:30',
            'parking_dimension_long' => 'required|numeric',
            'parking_dimension_height' => 'required|numeric',
            'parking_dimension_width' => 'required|numeric',
            'parking_dimension_icon' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $parking_dimension_id = $request->input('parking_dimension_id');
        $parking_dimension_name = $request->input('parking_dimension_name');
        $parking_dimension_size = $request->input('parking_dimension_size');
        $parking_dimension_long = $request->input('parking_dimension_long');
        $parking_dimension_height = $request->input('parking_dimension_height');
        $parking_dimension_width = $request->input('parking_dimension_width');
        # Unique 
        $count = DB::table('parkings_dimensions')->where('parking_dimension_name', $parking_dimension_name)->where('parking_dimension_id', '<>', $parking_dimension_id)->count();
        if ($count<1) {
            if ($request->hasFile('parking_dimension_icon')) {
                $extension = $request->file('parking_dimension_icon')->extension();
                $parking_dimension_icon = $parking_dimension_name.'.'.$extension;
                $request->parking_dimension_icon->storeAs('public', $parking_dimension_icon);
                # Update
                DB::table('parkings_dimensions')
                    ->where('parking_dimension_id', $parking_dimension_id)
                    ->update(
                        [
                            'parking_dimension_name' => $parking_dimension_name,
                            'parking_dimension_size' => $parking_dimension_size,
                            'parking_dimension_long' => $parking_dimension_long,
                            'parking_dimension_height' => $parking_dimension_height,
                            'parking_dimension_width' => $parking_dimension_width,
                            'parking_dimension_icon' => $parking_dimension_icon,
                        ]
                    );
            }else{
                # Update
                DB::table('parkings_dimensions')
                    ->where('parking_dimension_id', $parking_dimension_id)
                    ->update(
                        [
                            'parking_dimension_name' => $parking_dimension_name,
                            'parking_dimension_size' => $parking_dimension_size,
                            'parking_dimension_long' => $parking_dimension_long,
                            'parking_dimension_height' => $parking_dimension_height,
                            'parking_dimension_width' => $parking_dimension_width,
                        ]
                    );
            }
            return redirect('parkings_dimensions/edit/'.$parking_dimension_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('parkings_dimensions/edit/'.$parking_dimension_id)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parking_dimension_id)
    {
        $count = DB::table('parkings_dimensions')->where('parking_dimension_id', '=', $parking_dimension_id)->count();
        if ($count>0) {
            # Delete
            $data = DB::table('parkings_dimensions')->where('parking_dimension_id', '=', $parking_dimension_id)->first();
            Storage::delete($data->parking_dimension_icon);
            DB::table('parkings_dimensions')->where('parking_dimension_id', '=', $parking_dimension_id)->delete();
            return redirect('parkings_dimensions/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('parkings_dimensions/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
