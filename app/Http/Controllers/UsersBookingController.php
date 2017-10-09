<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB; 
use DateTime;

class UsersBookingController extends Controller
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
    public function index(Request $request, $user_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            # Request
            $method = $request->method();
            if ($request->isMethod('post')) {
                $today = $request->input('today');
                $date_array = explode('/',$today);
                $date_array = array_reverse($date_array);   
                $data['today'] = date(implode('-', $date_array));
                $data['search'] = $request->input('search');
                $data['parking_section_name'] = $request->input('parking_section_name');
                $data['parking_section'] = DB::table('parkings_sections')->where('parking_section_name',$data['parking_section_name'])->first();
            }else{
                $data['today'] = date("Y-m-d");
                $data['search'] = '';
                $data['parking_section_name']  = '';
                $data['parking_section'] = DB::table('parkings_sections')->first();
            }
            if ($request->session()->has('success')) {
                $data['today'] =  $request->session()->get('today');
                $data['search'] =  $request->session()->get('search');
                $data['parking_section_name']  =  $request->session()->get('parking_section_name');
            }
            if (date('Y-m-d') <= $data['today']) {
                $data['to_booking'] = true;
                $request->session()->forget('danger');
            }else{
                $data['to_booking'] = false;
                $request->session()->flash('danger', 'Las reservaciones inician el dia '.date('d/m/Y') );  
            }
            $data['parkings_sections'] = DB::table('parkings_sections')->get();
            $data['users_booking'] = DB::table('users')->where('user_id', '=', $user_id)->first();
            $data['parkings'] = DB::table('parkings')->where('parking_section_name', 'like', '%'.$data['parking_section_name'].'%')->get();
            $data['booking'] = DB::table('booking')
                ->whereDate('booking.booking_date', $data['today'])
                ->join('vehicles', 'vehicles.vehicle_code', '=', 'booking.vehicle_code')
                ->join('users', 'users.user_number_id', '=', 'vehicles.user_number_id')
                ->get();
            $data['rows'] = DB::table('parkings')
                ->join('parkings_sections', 'parkings_sections.parking_section_name', '=', 'parkings.parking_section_name')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_name', '=', 'parkings.vehicle_type_name')
                ->where('parkings_sections.parking_section_name', 'like', '%'.$data['parking_section_name'].'%')
                ->where(function ($query) use ($data)  {
                    $query->where('vehicles_types.vehicle_type_name', 'like', '%'.$data['search'].'%')
                        ->orWhere('parkings.parking_name', 'like', '%'.$data['search'].'%');
                })
                ->get();
            # View
            return view('users_booking.index', ['data' => $data]);
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
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
            $search = $request->input('search');
            $parking_section_name = $request->input('parking_section_name');
            $today = $request->input('today');

            return redirect('users_booking/index/'. $user_id)
                ->with('search', $search)
                ->with('parking_section_name', $parking_section_name )
                ->with('today', $today)
                ->with('success', 'Parqueadero Asignado');
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
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            # Rules
            $this->validate($request, [
                'booking_user_number_id_update' => 'required',
                'booking_vehicle_code' => 'required',
                'update_booking_id' => 'required',
                'booking_date' => 'required',
            ]);
            $user_number_id = $request->input('booking_parking_name');
            $vehicle_code = $request->input('booking_vehicle_code');
            $booking_id = $request->input('update_booking_id');
            $booking_date = $request->input('booking_date');
            # Update
            DB::table('booking')
                ->where('booking_id', $booking_id)
                ->update(
                    [
                        'vehicle_code' => $vehicle_code,
                    ]
                );
            $search = $request->input('search');
            $parking_section_name = $request->input('parking_section_name');
            $today = $request->input('today');

            return redirect('users_booking/index/'.$user_id)
                ->with('search', $search)
                ->with('parking_section_name', $parking_section_name )
                ->with('today', $today)
                ->with('success', 'Asignación Cambiada');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $user_id)
    {
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            $booking_id = $request->input('booking_id');
            $search = $request->input('search');
            $parking_section_name = $request->input('parking_section_name');
            $today = $request->input('today');
            DB::table('booking')->where('booking_id', '=', $booking_id)->delete();

            return redirect('users_booking/index/'.$user_id)
                ->with('search', $search)
                ->with('parking_section_name', $parking_section_name )
                ->with('today', $today)
                ->with('success', 'Asignacion Removida');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
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
