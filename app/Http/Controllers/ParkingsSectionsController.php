<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class ParkingsSectionsController extends Controller
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
        $data['rows'] = DB::table('parkings_sections')->where('parking_section_name', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('parkings_sections.index', ['data' => $data]);
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
        return view('parkings_sections.create', ['data' => $data]);
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
            'parking_section_name' => 'required|max:60|unique:parkings_sections,parking_section_name',
        ]);
        # Request
        $parking_section_name = $request->input('parking_section_name');
        # Insert
        DB::table('parkings_sections')->insert(
            ['parking_section_name' => $parking_section_name]
        );
        return redirect('parkings_sections/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parking_section_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->first();
            return view('parkings_sections.show', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings_sections/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($parking_section_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->count();
        if ($count>0) {
            # Edit
            $data['row'] = DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->first();
            return view('parkings_sections.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings_sections/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parking_section_id)
    {
        # Rules
        $this->validate($request, [
            'parking_section_name' => 'required|max:60',
        ]);
        # Request
        $parking_section_id = $request->input('parking_section_id');
        $parking_section_name = $request->input('parking_section_name');
        # Unique 
        $count = DB::table('parkings_sections')->where('parking_section_name', $parking_section_name)->where('parking_section_id', '<>', $parking_section_id)->count();
        if ($count<1) {
            # Update
            DB::table('parkings_sections')
                ->where('parking_section_id', $parking_section_id)
                ->update(['parking_section_name' => $parking_section_name]);
            return redirect('parkings_sections/edit/'.$parking_section_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('parkings_sections/edit/'.$parking_section_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parking_section_id)
    {
        $count = DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->count();
        if ($count>0) {
            # Delete
            DB::table('parkings_sections')->where('parking_section_id', '=', $parking_section_id)->delete();
            return redirect('parkings_sections/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('parkings_sections/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
