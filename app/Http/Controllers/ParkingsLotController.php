<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

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
        # View
        $data['vehicles_types'] = DB::table('vehicles_types')->get();
        $data['parkings_dimensions'] = DB::table('parkings_dimensions')->get();
        $data['parkings_sections'] = DB::table('parkings_sections')->get();
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
            'vehicle_type_name' => 'required',
            'parking_section_name' => 'required',
            'parking_number' => 'required|integer',
            'parking_name' => 'required|max:60|unique:parkings,parking_name',
        ]);
        # Request
        $parking_number = $request->input('parking_number');
        $vehicle_type_name = $request->input('vehicle_type_name');
        $parking_dimension_name = $request->input('parking_dimension_name');
        $parking_name = $request->input('parking_name');
        $parking_section_name = $request->input('parking_section_name');
        $parking_description = $request->input('parking_description');
        if ($parking_number > 0) {
            $insert = 1;
            $insert_ok = 0;
            do {
                $name = $parking_name.'_'.$insert;
                $count = DB::table('parkings')->where('parking_name', $name)->count();
                if ($count<1) {
                    if ($request->hasFile('parking_photo')) {
                        $extension = $request->file('parking_photo')->extension();
                        $parking_photo = $name.'.'.$extension;
                        $request->parking_photo->storeAs('public', $parking_photo);
                        # Insert
                        DB::table('parkings')->insert(
                            [
                                'vehicle_type_name' => $vehicle_type_name,
                                'parking_dimension_name' => $parking_dimension_name,
                                'parking_section_name' => $parking_section_name,
                                'parking_name' => $name,
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
                                'parking_name' => $name,
                                'parking_description' => $parking_description,
                            ]
                        );
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
