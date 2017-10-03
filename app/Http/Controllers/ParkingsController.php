<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class ParkingsController extends Controller
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
        $data['rows'] = DB::table('parkings')
            ->join('parkings_sections', 'parkings_sections.parking_section_name', '=', 'parkings.parking_section_name')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'parkings.vehicle_type_name')
            ->leftJoin('parkings_dimensions', 'parkings_dimensions.parking_dimension_name', '=', 'parkings.parking_dimension_name')
            ->where('parkings.parking_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_types.vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('parkings_sections.parking_section_name', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('parkings.index', ['data' => $data]);
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
        $data['parkings_dimensions'] = DB::table('parkings_dimensions')->get();
        $data['parkings_sections'] = DB::table('parkings_sections')->get();
        return view('parkings.create', ['data' => $data]);
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
            'parking_section_name' => 'required',
            'parking_name' => 'required|max:60|unique:parkings,parking_name',
        ]);
        # Request
        $vehicle_type_name = $request->input('vehicle_type_name');
        $parking_dimension_name = $request->input('parking_dimension_name');
        $parking_name = $request->input('parking_name');
        $parking_section_name = $request->input('parking_section_name');
        $parking_description = $request->input('parking_description');
        if ($request->hasFile('parking_photo')) {
            $extension = $request->file('parking_photo')->extension();
            $parking_photo = $vehicle_type_name.'.'.$extension;
            $request->parking_photo->storeAs('public', $parking_photo);
            # Insert
            DB::table('parkings')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'parking_dimension_name' => $parking_dimension_name,
                    'parking_section_name' => $parking_section_name,
                    'parking_name' => $parking_name,
                    'parking_description' => $parking_description,
                    'parking_photo' => $parking_photo,
                ]
            );
        }else{
            # Insert
            DB::table('parkings')->insert(
                [
                    'vehicle_type_name' => $vehicle_type_name,
                    'parking_dimension_name' => $parking_dimension_name,
                    'parking_section_name' => $parking_section_name,
                    'parking_name' => $parking_name,
                    'parking_description' => $parking_description,
                ]
            );
        }
        return redirect('parkings/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parking_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('parkings')->where('parking_id', '=', $parking_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = 
                DB::table('parkings')
                    ->join('parkings_sections', 'parkings_sections.parking_section_name', '=', 'parkings.parking_section_name')
                    ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'parkings.vehicle_type_name')
                    ->leftJoin('parkings_dimensions', 'parkings_dimensions.parking_dimension_name', '=', 'parkings.parking_dimension_name')
                    ->where('parking_id', '=', $parking_id)->first();
            return view('parkings.show', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($parking_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('parkings')->where('parking_id', '=', $parking_id)->count();
        if ($count>0) {
            # Edit
            $data['vehicles_types'] = DB::table('vehicles_types')->get();
            $data['parkings_dimensions'] = DB::table('parkings_dimensions')->get();
            $data['parkings_sections'] = DB::table('parkings_sections')->get();
            $data['row'] = 
                DB::table('parkings')
                    ->join('parkings_sections', 'parkings_sections.parking_section_name', '=', 'parkings.parking_section_name')
                    ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'parkings.vehicle_type_name')
                    ->leftJoin('parkings_dimensions', 'parkings_dimensions.parking_dimension_name', '=', 'parkings.parking_dimension_name')
                    ->where('parking_id', '=', $parking_id)->first();
            return view('parkings.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('parkings/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parking_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_name' => 'required',
            'parking_section_name' => 'required',
            'parking_name' => 'required|max:60',
        ]);
        # Request
        $parking_id = $request->input('parking_id');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $parking_dimension_name = $request->input('parking_dimension_name');
        $parking_name = $request->input('parking_name');
        $parking_section_name = $request->input('parking_section_name');
        $parking_description = $request->input('parking_description');
        # Unique 
        $count = DB::table('parkings')->where('parking_name', $parking_name)->where('parking_id', '<>', $parking_id)->count();
        if ($count<1) {
            if ($request->hasFile('parking_photo')) {
                $extension = $request->file('parking_photo')->extension();
                $parking_photo = $vehicle_type_name.'.'.$extension;
                $request->parking_photo->storeAs('public', $parking_photo);
                # Update
                DB::table('parkings')
                    ->where('parking_id', $parking_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'parking_dimension_name' => $parking_dimension_name,
                            'parking_section_name' => $parking_section_name,
                            'parking_name' => $parking_name,
                            'parking_description' => $parking_description,
                            'parking_photo' => $parking_photo,
                        ]
                    );
            }else{
                # Update
                DB::table('parkings')
                    ->where('parking_id', $parking_id)
                    ->update(
                        [
                            'vehicle_type_name' => $vehicle_type_name,
                            'parking_dimension_name' => $parking_dimension_name,
                            'parking_section_name' => $parking_section_name,
                            'parking_name' => $parking_name,
                            'parking_description' => $parking_description,
                        ]
                    );
            }
            return redirect('parkings/edit/'.$parking_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('parkings/edit/'.$parking_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parking_id)
    {
        $count = DB::table('parkings')->where('parking_id', '=', $parking_id)->count();
        if ($count>0) {
            # Delete
            $data = DB::table('parkings')->where('parking_id', '=', $parking_id)->first();
            Storage::delete($data->parking_photo);
            DB::table('parkings')->where('parking_id', '=', $parking_id)->delete();
            return redirect('parkings/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('parkings/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
