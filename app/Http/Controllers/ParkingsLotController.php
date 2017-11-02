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

class ParkingsLotController extends Controller
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
        return view('parkings_lot.create', ['data' => $data]);
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
            'parking_number' => 'required|integer',
            'parking_name' => 'required|max:60|unique:parkings,parking_name',
        ]);
        # Request
        $parking_number = $request->input('parking_number');
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $parking_section_uid = $request->input('parking_section_uid');
        $parking_dimension_uid = $request->input('parking_dimension_uid');
        $parking_name = $request->input('parking_name');
        $parking_description = $request->input('parking_description');
        if ($parking_number > 0) {
            $insert = 1;
            $insert_ok = 0;
            do {
                $parking_uid  = Uuid::generate()->string;
                $name = $parking_name.'_'.$insert;
                $count = Parking::where('parking_name', $name)->count();
                if ($count<1) {
                    if ($request->hasFile('parking_photo')) {
                        $extension = $request->file('parking_photo')->extension();
                        $parking_photo = $parking_uid.'.'.$extension;
                        $request->parking_photo->storeAs('public', $parking_photo);
                        # Insert
                        $parking = new Parking;
                        $parking->vehicle_type_uid  = $vehicle_type_uid;
                        $parking->parking_section_uid = $parking_section_uid;
                        $parking->parking_dimension_uid  = $parking_dimension_uid;
                        $parking->parking_name  = $name;
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
                        $parking->parking_name  = $name;
                        $parking->parking_description  = $parking_description;
                        $parking->parking_uid  = $parking_uid;
                        $parking->save();
                    }
                    $insert_ok++;
                }
                $insert++;
            } while ($parking_number > $insert_ok);
            return redirect('parkings_lot/create')->with('success', 'Registro Guardado');
        }else{
            # Error
            return redirect('parkings_lot/create')->with('danger', 'La Cantidad de Parqueaderos debe ser mayor a Cero.');
        }
    }
}
