<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class UsersController extends Controller
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
        $data['rows'] = DB::table('users')
            ->join('roles', 'roles.rol_name', '=', 'users.user_rol_name')
            ->where('user_firstname', 'like', '%'.$search.'%')
            ->orWhere('user_lastname', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('user_type_description', 'like', '%'.$search.'%')
            ->orWhere('user_division_description', 'like', '%'.$search.'%')
            ->orWhere('user_position_description', 'like', '%'.$search.'%')
            ->orWhere('user_number_id', 'like', '%'.$search.'%')
            ->orWhere('user_number_employee', 'like', '%'.$search.'%')
            ->orWhere('rol_name', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('users.index', ['data' => $data]);
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
        $data['users_types'] = DB::table('users_types')->get();
        $data['users_positions'] = DB::table('users_positions')->get();
        $data['users_divisions'] = DB::table('users_divisions')->get();
        $data['roles'] = DB::table('roles')->get();
        # View
        return view('users.create', ['data' => $data]);
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
            'user_number_id' => 'required|max:60|unique:users,user_number_id',
            'user_number_employee' => 'required|max:60|unique:users,user_number_employee',
            'user_firstname' => 'required|max:60',
            'user_lastname' => 'required|max:60',
            'user_type_description' => 'required',
            'user_division_description' => 'required',
            'user_position_description' => 'required',
            'email' => 'required|max:160|unique:users,email|email',
            'user_rol_name' => 'required',
            'user_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 16;
        $password = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $user_number_id = $request->input('user_number_id');
        $user_number_employee = $request->input('user_number_employee');
        $user_firstname = $request->input('user_firstname');
        $user_lastname = $request->input('user_lastname');
        $user_type_description = $request->input('user_type_description');
        $user_division_description = $request->input('user_division_description');
        $user_position_description = $request->input('user_position_description');
        $email = $request->input('email');
        $user_rol_name = $request->input('user_rol_name');
        if ($request->hasFile('user_image')) {
            $extension = $request->file('user_image')->extension();
            $user_image = $user_number_id.'.'.$extension;
            $request->user_image->storeAs('public', $user_image);
            # Insert
            DB::table('users')->insert(
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
                    'password' => $password,
                    'user_image' => $user_image,
                ]
            );
        }else{
            # Insert
            DB::table('users')->insert(
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
                    'password' => $password,
                ]
            );
        }
        return redirect('users/create')->with('success', 'Registro Guardado');
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
}
