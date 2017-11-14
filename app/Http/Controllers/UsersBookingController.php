<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Booking;
use App\ParkingSection;
use App\Vehicle;
use App\VehicleType;
use App\VehicleBrand;
use App\VehicleModel;
use App\VehicleColor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;
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
    public function index(Request $request, $user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # Request
            $method = $request->method();
            if ($request->isMethod('post')) {
                $today = $request->input('today');
                $date_array = explode('/',$today);
                $date_array = array_reverse($date_array);   
                $data['today'] = date(implode('-', $date_array));
                $data['search'] = $request->input('search');
                $data['parking_section_uid'] = $request->input('parking_section_uid');
                $data['parking_section'] = ParkingSection::where('parking_section_uid', $data['parking_section_uid'])->first();
            }else{
                $data['today'] = date("Y-m-d");
                $data['search'] = '';
                $data['parking_section_uid']  = '';
                $data['parking_section'] = ParkingSection::first();
            }
            if ($request->session()->has('success')) {
                $data['today'] =  $request->session()->get('today');
                $data['search'] =  $request->session()->get('search');
                $data['parking_section_uid']  =  $request->session()->get('parking_section_uid');
            }
            if (date('Y-m-d') <= $data['today']) {
                $data['to_booking'] = true;
                $request->session()->forget('danger');
            }else{
                $data['to_booking'] = false;
                $request->session()->flash('danger', 'Las reservaciones inician el dia '.date('d/m/Y') );  
            }
            $data['parkings_sections'] = ParkingSection::get();
            $data['users_booking'] = User::where('user_uid', $user_uid)->first();
            $data['parkings'] = ParkingSection::where('parking_section_uid', 'like', '%'.$data['parking_section_uid'].'%')->get();
            $data['booking'] = DB::table('booking')
                ->whereDate('booking.booking_date', $data['today'])
                ->join('vehicles', 'vehicles.vehicle_uid', '=', 'booking.vehicle_uid')
                ->join('users', 'users.user_uid', '=', 'vehicles.user_uid')
                ->get();
            $data['rows'] = DB::table('parkings')
                ->join('parkings_sections', 'parkings_sections.parking_section_uid', '=', 'parkings.parking_section_uid')
                ->join('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'parkings.vehicle_type_uid')
                ->where('parkings_sections.parking_section_uid', 'like', '%'.$data['parking_section_uid'].'%')
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
    public function store(Request $request, $user_uid)
    {
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # Rules
            $this->validate($request, [
                'booking_vehicle_uid' => 'required',
                'parking_uid' => 'required',
                'booking_date' => 'required',
            ]);
            $vehicle_uid = $request->input('booking_vehicle_uid');
            $parking_uid = $request->input('parking_uid');
            $booking_date = $request->input('booking_date');
            $booking_uid = Uuid::generate()->string;
            # Insert
            $booking = New Booking;
            $booking->vehicle_uid = $vehicle_uid;
            $booking->parking_uid = $parking_uid;
            $booking->booking_date = $booking_date;
            $booking->booking_uid = $booking_uid; 
            $booking->save();
            # Search
            $search = $request->input('search');
            $parking_section_uid = $request->input('parking_section_uid');
            $today = $request->input('today');

            return redirect('users_booking/index/'. $user_uid)
                ->with('search', $search)
                ->with('parking_section_uid', $parking_section_uid )
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
    public function update(Request $request, $user_uid)
    {
        $count = DB::table('users')->where('user_uid', '=', $user_uid)->count();
        if ($count>0) {
            # Rules
            $this->validate($request, [
                'update_booking_uid' => 'required',
                'booking_vehicle_uid' => 'required',
            ]);
            $booking_uid = $request->input('update_booking_uid');
            $vehicle_uid = $request->input('booking_vehicle_uid');
            # Update
            $booking = Booking::where('booking_uid', $booking_uid)->first();
            $booking->vehicle_uid = $vehicle_uid;
            $booking->save();
            # Search
            $search = $request->input('search');
            $parking_section_uid = $request->input('parking_section_uid');
            $today = $request->input('today');

            return redirect('users_booking/index/'.$user_uid)
                ->with('search', $search)
                ->with('parking_section_uid', $parking_section_uid )
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
    public function destroy(Request $request, $user_uid)
    {
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            $booking_uid = $request->input('booking_uid');
            $search = $request->input('search');
            $parking_section_uid = $request->input('parking_section_uid');
            $today = $request->input('today');
            Booking::where('booking_uid', $booking_uid)->delete();

            return redirect('users_booking/index/'.$user_uid)
                ->with('search', $search)
                ->with('parking_section_uid', $parking_section_uid )
                ->with('today', $today)
                ->with('success', 'Asignacion Removida');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Ver el registro');
        }
    }

    public function getvehicles(Request $request, $user_uid, $booking_date)
    {
        $data['rows'] = DB::table('vehicles')
            ->where('vehicles.user_uid', $user_uid)
            ->whereNotIn('vehicles.vehicle_uid', 
                function($query) use ($booking_date) {
                    $query->select('vehicle_uid')
                    ->from('booking')
                    ->whereDate('booking_date',$booking_date);
                }   
            )
            ->get();
        return response()->json($data['rows']);
    }
}
