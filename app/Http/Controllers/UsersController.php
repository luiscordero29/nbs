<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\UserType;
use App\UserPosition;
use App\UserDivision;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;


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
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
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
        $data['rows'] = User::where('user_firstname', 'like', '%'.$search.'%')
            ->orWhere('user_lastname', 'like', '%'.$search.'%')
            ->orWhere('user_number_id', 'like', '%'.$search.'%')
            ->orWhere('user_number_employee', 'like', '%'.$search.'%')
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
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        # Data
        $data['users_types'] = UserType::get();
        $data['users_positions'] = UserPosition::get();
        $data['users_divisions'] = UserDivision::get();
        $data['roles'] = Role::get();
        # View
        $request->session()->forget('info');
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
            'email' => 'required|max:160|unique:users,email|email',
            'role_uid' => 'required',
            'user_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 16;
        $email = $request->input('email');
        $password = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        $user_number_id = $request->input('user_number_id');
        $user_number_employee = $request->input('user_number_employee');
        $user_firstname = $request->input('user_firstname');
        $user_lastname = $request->input('user_lastname');
        $role_uid = $request->input('role_uid');
        $user_type_uid = $request->input('users_user_type_uid');
        $user_division_uid = $request->input('users_user_division_uid');
        $user_position_uid = $request->input('users_user_position_uid');
        $user_uid = Uuid::generate()->string;
        if ($request->hasFile('user_image')) {
            $extension = $request->file('user_image')->extension();
            $user_image = $user_uid.'.'.$extension;
            $request->user_image->storeAs('public', $user_image);
            # Insert
            $user = New User;
            $user->email = $email;
            $user->password = $password;
            $user->user_number_id = $user_number_id;
            $user->user_number_employee = $user_number_employee;
            $user->user_firstname = $user_firstname;
            $user->user_lastname = $user_lastname;
            $user->role_uid = $role_uid;
            $user->user_image = $user_image;
            $user->user_type_uid = $user_type_uid;
            $user->user_division_uid = $user_division_uid;
            $user->user_position_uid = $user_position_uid;
            $user->user_uid = $user_uid;
            $user->save();
            
        }else{
            # Insert
            $user = New User;
            $user->email = $email;
            $user->password = $password;
            $user->user_number_id = $user_number_id;
            $user->user_number_employee = $user_number_employee;
            $user->user_firstname = $user_firstname;
            $user->user_lastname = $user_lastname;
            $user->role_uid = $role_uid;
            $user->user_type_uid = $user_type_uid;
            $user->user_division_uid = $user_division_uid;
            $user->user_position_uid = $user_position_uid;
            $user->user_uid = $user_uid;
            $user->save();
        }
        return redirect('users/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = User::where('user_uid', $user_uid)->first();
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
    public function edit($user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users/index';
        $count = User::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # Edit
            $data['users_types'] = UserType::get();
            $data['users_positions'] = UserPosition::get();
            $data['users_divisions'] = UserDivision::get();
            $data['roles'] = Role::get();
            $data['row'] = User::where('user_uid', $user_uid)->first();
            $request->session()->forget('info');
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
    public function update(Request $request, $user_uid)
    {
        # Rules
        $this->validate($request, [
            'user_number_id' => 'required|max:60',
            'user_number_employee' => 'required|max:60',
            'user_firstname' => 'required|max:60',
            'user_lastname' => 'required|max:60',
            'email' => 'required|max:160|email',
            'role_uid' => 'required',
            'user_image' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $user_uid = $request->input('user_uid');
        $email = $request->input('email');
        $user_number_id = $request->input('user_number_id');
        $user_number_employee = $request->input('user_number_employee');
        $user_firstname = $request->input('user_firstname');
        $user_lastname = $request->input('user_lastname');
        $role_uid = $request->input('role_uid');
        $user_type_uid = $request->input('users_user_type_uid');
        $user_division_uid = $request->input('users_user_division_uid');
        $user_position_uid = $request->input('users_user_position_uid');
        # Unique 
        $count_user_number_id = User::where('user_number_id', $user_number_id)->where('user_uid', '<>', $user_uid)->count();
        $count_user_number_employee = User::where('user_number_employee', $user_number_employee)->where('user_uid', '<>', $user_uid)->count();
        $count_email = User::where('email', $email)->where('user_uid', '<>', $user_uid)->count();
        if ($count_user_number_id<1 or $count_user_number_employee<1 or $count_email<1) {
            if ($request->hasFile('user_image')) {
                $extension = $request->file('user_image')->extension();
                $user_image = $user_uid.'.'.$extension;
                $request->user_image->storeAs('public', $user_image);
                # Update
                $user = User::where('user_uid', $user_uid)->first();
                $user->user_number_id = $user_number_id;
                $user->user_number_employee = $user_number_employee;
                $user->user_firstname = $user_firstname;
                $user->user_lastname = $user_lastname;
                $user->user_type_uid = $user_type_uid;
                $user->user_division_uid = $user_division_uid;
                $user->user_position_uid = $user_position_uid;
                $user->role_uid = $role_uid;
                $user->email = $email;
                $user->user_image = $user_image;
                $user->save();
            }else{
                # Update
                $user = User::where('user_uid', $user_uid)->first();
                $user->user_number_id = $user_number_id;
                $user->user_number_employee = $user_number_employee;
                $user->user_firstname = $user_firstname;
                $user->user_lastname = $user_lastname;
                $user->user_type_uid = $user_type_uid;
                $user->user_division_uid = $user_division_uid;
                $user->user_position_uid = $user_position_uid;
                $user->role_uid = $role_uid;
                $user->email = $email;
                $user->save();
            }
            return redirect('users/edit/'.$user_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            if ($count_user_number_id<1 ) {
                return redirect('users/edit/'.$user_uid)->with('danger', 'El elemento Número ID ya está en uso.');
            }
            if ($count_user_number_employee<1 ) {
                return redirect('users/edit/'.$user_uid)->with('danger', 'El elemento Número de Empleado ya está en uso.');
            }
            if ($count_email<1 ) {
                return redirect('users/edit/'.$user_uid)->with('danger', 'El elemento E-mail ya está en uso.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_uid)
    {
        $count = User::where('user_uid',$user_uid)->count();
        if ($count>0) {
            # Delete
            $data = User::where('user_uid', $user_uid)->first();
            Storage::delete($data->user_uid);
            User::where('user_uid', $user_uid)->delete();
            return redirect('users/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('users/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
