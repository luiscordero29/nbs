<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ParkingSection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

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
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_sections/index';
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
        $data['rows'] = ParkingSection::where('parking_section_name', 'like', '%'.$search.'%')->paginate(30);
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
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_sections/index';
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
        $parking_section = new ParkingSection;
        $parking_section->parking_section_name = $parking_section_name;
        $parking_section->parking_section_uid  = Uuid::generate()->string;
        $parking_section->save();
        return redirect('parkings_sections/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parking_section_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_sections/index';
        $count = ParkingSection::where('parking_section_uid', $parking_section_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = ParkingSection::where('parking_section_uid', $parking_section_uid)->first();
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
    public function edit($parking_section_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings_sections/index';
        $count = ParkingSection::where('parking_section_uid', $parking_section_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = ParkingSection::where('parking_section_uid', $parking_section_uid)->first();
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
    public function update(Request $request, $parking_section_uid)
    {
        # Rules
        $this->validate($request, [
            'parking_section_name' => 'required|max:60',
        ]);
        # Request
        $parking_section_uid = $request->input('parking_section_uid');
        $parking_section_name = $request->input('parking_section_name');
        # Unique 
        $count = ParkingSection::where('parking_section_name', $parking_section_name)->where('parking_section_uid', '<>', $parking_section_uid)->count();
        if ($count<1) {
            # Update
            $parking_section = ParkingSection::where('parking_section_uid', $parking_section_uid)->first();
            $parking_section->parking_section_name = $parking_section_name;
            $parking_section->save();
            return redirect('parkings_sections/edit/'.$parking_section_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('parkings_sections/edit/'.$parking_section_uid)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parking_section_uid)
    {
        $count = ParkingSection::where('parking_section_uid', $parking_section_uid)->count();
        if ($count>0) {
            # Delete
            ParkingSection::where('parking_section_uid', $parking_section_uid)->delete();
            return redirect('parkings_sections/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('parkings_sections/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
