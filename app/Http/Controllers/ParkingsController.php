<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Parking;
use App\ParkingDimension;
use App\ParkingSection;
use App\VehicleType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

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
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings/index';
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
            ->join('parkings_sections', 'parkings_sections.parking_section_uid', '=', 'parkings.parking_section_uid')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'parkings.vehicle_type_uid')
            ->leftJoin('parkings_dimensions', 'parkings_dimensions.parking_dimension_uid', '=', 'parkings.parking_dimension_uid')
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
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings/index';
        # View
        $data['vehicles_types'] = VehicleType::get();
        $data['parkings_dimensions'] = ParkingDimension::get();
        $data['parkings_sections'] = ParkingSection::get();
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
            'vehicle_type_uid' => 'required',
            'parking_section_uid' => 'required',
            'parking_name' => 'required|max:60|unique:parkings,parking_name',
        ]);
        # Request
        $parking_uid  = Uuid::generate()->string;
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $parking_section_uid = $request->input('parking_section_uid');
        $parking_dimension_uid = $request->input('parking_dimension_uid');
        $parking_name = $request->input('parking_name');
        $parking_description = $request->input('parking_description');
        if ($request->hasFile('parking_photo')) {
            $extension = $request->file('parking_photo')->extension();
            $parking_photo = $parking_uid.'.'.$extension;
            $request->parking_photo->storeAs('public', $parking_photo);
            # Insert
            $parking = new Parking;
            $parking->vehicle_type_uid  = $vehicle_type_uid;
            $parking->parking_section_uid = $parking_section_uid;
            $parking->parking_dimension_uid  = $parking_dimension_uid;
            $parking->parking_name  = $parking_name;
            $parking->parking_description  = $parking_description;
            $parking->parking_photo  = $parking_photo;
            $parking->parking_uid  = $parking_uid;
            $parking->save();
        }else{
            # Insert
            $parking = new Parking;
            $parking->vehicle_type_uid  = $vehicle_type_uid;
            $parking->parking_section_uid = $parking_section_uid;
            $parking->parking_dimension_uid  = $parking_dimension_uid;
            $parking->parking_name  = $parking_name;
            $parking->parking_description  = $parking_description;
            $parking->parking_uid  = $parking_uid;
            $parking->save();
        }
        return redirect('parkings/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($parking_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings/index';
        $count = Parking::where('parking_uid', $parking_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = Parking::where('parking_uid', $parking_uid)->first();
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
    public function edit($parking_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'parkings';
        $data['subitem'] = 'parkings/index';
        $count = Parking::where('parking_uid', $parking_uid)->count();
        if ($count>0) {
            # Edit
            $data['vehicles_types'] = VehicleType::get();
            $data['parkings_dimensions'] = ParkingDimension::get();
            $data['parkings_sections'] = ParkingSection::get();
            $data['row'] = Parking::where('parking_uid', $parking_uid)->first();
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
    public function update(Request $request, $parking_uid)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_uid' => 'required',
            'parking_section_uid' => 'required',
            'parking_name' => 'required|max:60',
        ]);
        # Request
        $parking_uid = $request->input('parking_uid');
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $parking_section_uid = $request->input('parking_section_uid');
        $parking_dimension_uid = $request->input('parking_dimension_uid');
        $parking_name = $request->input('parking_name');
        $parking_description = $request->input('parking_description');
        # Unique 
        $count = Parking::where('parking_name', $parking_name)->where('parking_uid', '<>', $parking_uid)->count();
        if ($count<1) {
            if ($request->hasFile('parking_photo')) {
                $extension = $request->file('parking_photo')->extension();
                $parking_photo = $parking_uid.'.'.$extension;
                $request->parking_photo->storeAs('public', $parking_photo);
                # Update
                $parking = Parking::where('parking_uid', $parking_uid)->first();
                $parking->vehicle_type_uid  = $vehicle_type_uid;
                $parking->parking_section_uid = $parking_section_uid;
                $parking->parking_dimension_uid  = $parking_dimension_uid;
                $parking->parking_name  = $parking_name;
                $parking->parking_description  = $parking_description;
                $parking->parking_photo  = $parking_photo;
                $parking->save();
            }else{
                # Update
                $parking = Parking::where('parking_uid', $parking_uid)->first();
                $parking->vehicle_type_uid  = $vehicle_type_uid;
                $parking->parking_section_uid = $parking_section_uid;
                $parking->parking_dimension_uid  = $parking_dimension_uid;
                $parking->parking_name  = $parking_name;
                $parking->parking_description  = $parking_description;
                $parking->save();
            }
            return redirect('parkings/edit/'.$parking_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('parkings/edit/'.$parking_uid)->with('danger', 'El elemento Nombre ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($parking_uid)
    {
        $count = Parking::where('parking_uid', $parking_uid)->count();
        if ($count>0) {
            # Delete
            $data = Parking::where('parking_uid', $parking_uid)->first();
            Storage::delete($data->parking_photo);
            Parking::where('parking_uid', $parking_uid)->delete();
            return redirect('parkings/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('parkings/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
