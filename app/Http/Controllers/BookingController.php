<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB; 
use DateTime;

class BookingController extends Controller
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
        if ($request->isMethod('post')) {
            $search = $request->input('search');
            $today = $request->input('today');
            $date_array = explode('/',$today);
            $date_array = array_reverse($date_array);   
            $data['today'] = date(implode('-', $date_array));
            $parking_section_name = $request->input('parking_section_name');
            $data['parking_section'] = DB::table('parkings_sections')->where('parking_section_name',$parking_section_name)->first();
        }else{
            $search = '';
            $parking_section_name  = '';
            $data['today'] = date("Y-m-d");
            $data['parking_section'] = DB::table('parkings_sections')->first();
        }
        $data['parkings_sections'] = DB::table('parkings_sections')->get();
        $data['users'] = DB::table('users')->get();
        $data['parkings'] = DB::table('parkings')->where('parking_section_name',$data['parking_section']->parking_section_name)->get();
        $data['booking'] = DB::table('booking')
            ->whereDate('booking.booking_date', $data['today'])
            ->join('vehicles', 'vehicles.vehicle_code', '=', 'booking.vehicle_code')
            ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
            ->get();
        $data['rows'] = DB::table('parkings')
            ->join('parkings_sections', 'parkings_sections.parking_section_name', '=', 'parkings.parking_section_name')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'parkings.vehicle_type_name')
            ->where('parkings_sections.parking_section_name', 'like', '%'.$parking_section_name.'%')
            ->where(function ($query) use ($search)  {
                $query->where('vehicles_types.vehicle_type_name', 'like', '%'.$search.'%')
                    ->orWhere('parkings.parking_name', 'like', '%'.$search.'%')
                    ->orWhere('parkings.parking_description', 'like', '%'.$search.'%');
            })
            ->get();
        # View
        return view('booking.index', ['data' => $data]);
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
            'booking_user_number_id' => 'required',
            'booking_vehicle_code' => 'required',
            'parking_name' => 'required',
            'booking_date' => 'required',
        ]);
        $user_number_id = $request->input('booking_parking_name');
        $vehicle_code = $request->input('booking_vehicle_code');
        $parking_name = $request->input('parking_name');
        $booking_date = $request->input('booking_date');
        # Insert
        DB::table('booking')->insert(
            [
                'vehicle_code' => $vehicle_code,
                'parking_name' => $parking_name,
                'booking_date' => $booking_date,
            ]
        );
        return redirect('booking/index')->with('success', 'Parqueadero Asignado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('users')->join('roles', 'roles.rol_name', '=', 'users.user_rol_name')->where('user_id', '=', $user_id)->first();
            return view('users.show', ['data' => $data]);
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            # Edit
            $data['users_types'] = DB::table('users_types')->get();
            $data['users_positions'] = DB::table('users_positions')->get();
            $data['users_divisions'] = DB::table('users_divisions')->get();
            $data['roles'] = DB::table('roles')->get();
            $data['row'] = DB::table('users')->join('roles', 'roles.rol_name', '=', 'users.user_rol_name')->where('user_id', '=', $user_id)->first();
            return view('users.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        # Rules
        $this->validate($request, [
            'user_number_id' => 'required|max:60',
            'user_number_employee' => 'required|max:60',
            'user_firstname' => 'required|max:60',
            'user_lastname' => 'required|max:60',
            'user_type_description' => 'required',
            'user_division_description' => 'required',
            'user_position_description' => 'required',
            'email' => 'required|max:160|email',
            'user_rol_name' => 'required',
            'user_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $user_id = $request->input('user_id');
        $user_number_id = $request->input('user_number_id');
        $user_number_employee = $request->input('user_number_employee');
        $user_firstname = $request->input('user_firstname');
        $user_lastname = $request->input('user_lastname');
        $user_type_description = $request->input('user_type_description');
        $user_division_description = $request->input('user_division_description');
        $user_position_description = $request->input('user_position_description');
        $email = $request->input('email');
        $user_rol_name = $request->input('user_rol_name');
        # Unique 
        $count_user_number_id = DB::table('users')->where('user_number_id', $user_number_id)->where('user_id', '<>', $user_id)->count();
        $count_user_number_employee = DB::table('users')->where('user_number_employee', $user_number_employee)->where('user_id', '<>', $user_id)->count();
        $count_email = DB::table('users')->where('email', $email)->where('user_id', '<>', $user_id)->count();
        if ($count_user_number_id<1 or $count_user_number_employee<1 or $count_email<1) {
            if ($request->hasFile('vehicle_type_icon')) {
                $extension = $request->file('vehicle_type_icon')->extension();
                $vehicle_type_icon = $vehicle_type_name.'.'.$extension;
                $request->vehicle_type_icon->storeAs('public', $vehicle_type_icon);
                # Update
                DB::table('users')
                    ->where('user_id', $user_id)
                    ->update(
                        [
                            'user_number_id' => $user_number_id,
                            'user_number_employee' => $user_number_employee,
                            'user_firstname' => $user_firstname,
                            'user_lastname' => $user_lastname,
                            'user_type_description' => $user_type_description,
                            'user_division_description' => $user_division_description,
                            'user_position_description' => $user_position_description,
                            'user_rol_name' => $user_rol_name,
                            'email' => $email,
                            'user_image' => $user_image,
                        ]
                    );
            }else{
                # Update
                DB::table('users')
                    ->where('user_id', $user_id)
                    ->update(
                        [
                            'user_number_id' => $user_number_id,
                            'user_number_employee' => $user_number_employee,
                            'user_firstname' => $user_firstname,
                            'user_lastname' => $user_lastname,
                            'user_type_description' => $user_type_description,
                            'user_division_description' => $user_division_description,
                            'user_position_description' => $user_position_description,
                            'user_rol_name' => $user_rol_name,
                            'email' => $email,
                        ]
                    );
            }
            return redirect('users/edit/'.$user_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            if ($count_user_number_id<1 ) {
                return redirect('users/edit/'.$user_id)->with('danger', 'El elemento Número ID ya está en uso.');
            }
            if ($count_user_number_employee<1 ) {
                return redirect('users/edit/'.$user_id)->with('danger', 'El elemento Número de Empleado ya está en uso.');
            }
            if ($count_email<1 ) {
                return redirect('users/edit/'.$user_id)->with('danger', 'El elemento E-mail ya está en uso.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            # Delete
            $data = DB::table('users')->where('user_id', '=', $user_id)->first();
            Storage::delete($data->user_number_id);
            DB::table('users')->where('user_id', '=', $user_id)->delete();
            return redirect('users/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Eliminar el registro');
        }
    }

    public function getvehicles(Request $request, $user_number_id, $booking_date)
    {
        $data['rows'] = DB::table('vehicles')
            ->where('vehicles.user_number_id', $user_number_id)
            ->whereNotIn('vehicles.vehicle_code', 
                function($query) use ($booking_date) {
                    $query->select('vehicle_code')
                    ->from('booking')
                    ->whereDate('booking_date',$booking_date);
                }   
            )
            ->get();
        return response()->json($data['rows']);
    }
}
