<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = Auth::user();
        return view('dashboard.index', ['data' => $data]);
    }
    
    public function login()
    {
        return view('auth.login');
    }

    public function profile()
    {
        $data['user'] = Auth::user();
        return view('dashboard.profile', ['data' => $data]);
    }

    public function profile_edit()
    {
        $data['user'] = Auth::user();
        return view('dashboard.profile_edit', ['data' => $data]);
    }

    public function profile_edit_store(Request $request)
    {
        $data['user'] = Auth::user();
        # Rules
        $this->validate($request, [
            'user_firstname' => 'required|max:60',
            'user_lastname' => 'required|max:60',
            'email' => 'required|max:160|email',
        ]);
        # Request
        $user_id = $request->input('user_id');
        $user_firstname = $request->input('user_firstname');
        $user_lastname = $request->input('user_lastname');
        $email = $request->input('email');
        # Unique 
        $count_email = DB::table('users')->where('email', $email)->where('user_id', '<>', $user_id)->count();
        if ($count_email<1) {            
            # Update
            DB::table('users')
                ->where('user_id', $user_id)
                ->update(
                    [ 
                        'user_firstname' => $user_firstname,
                        'user_lastname' => $user_lastname,
                        'email' => $email,
                    ]
                );
            return redirect('dashboard/profile/edit')->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('dashboard/profile/edit')->with('danger', 'El elemento E-mail ya está en uso.');
        }
    }

    public function profile_upload()
    {
        $data['user'] = Auth::user();
        return view('dashboard.profile_upload', ['data' => $data]);
    }

    public function profile_upload_store(Request $request)
    {
        $data['user'] = Auth::user();
        # Rules
        $this->validate($request, [
            'user_image' => 'required|image|mimes:jpeg,png',
        ]);
        # Request
        $user_id = $request->input('user_id');
        $user_number_id = $request->input('user_number_id');
        # Unique 
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {
            if ($request->hasFile('user_image')) {
                $extension = $request->file('user_image')->extension();
                $user_image = $user_number_id.'.'.$extension;
                $request->user_image->storeAs('public', $user_image);
                # Update
                DB::table('users')
                    ->where('user_id', $user_id)
                    ->update(
                        [
                            'user_image' => $user_image,
                        ]
                    );
                return redirect('dashboard/profile/upload')->with('success', 'Registro Actualizado');
            }else{
                # Error
                return redirect('dashboard/profile/upload')->with('danger', 'Error al enviar la imagen');
            }
        }else{
            # Error
            return redirect('dashboard/profile/upload')->with('danger', 'El elemento no existe.');
        }
    }

    public function profile_password()
    {
        $data['user'] = Auth::user();
        return view('dashboard.profile_password', ['data' => $data]);
    }

    public function profile_password_store(Request $request)
    {
        $data['user'] = Auth::user();
        # Rules
        $this->validate($request, [
            'clave' => 'required',
            'repetir_clave' => 'required|same:clave',
        ]);
        # Request
        $user_id = $request->input('user_id');
        $clave = bcrypt($request->input('clave'));
        # Unique 
        $count = DB::table('users')->where('user_id', '=', $user_id)->count();
        if ($count>0) {           
            # Update
            DB::table('users')
                ->where('user_id', $user_id)
                ->update(
                    [ 
                        'password' => $clave,
                    ]
                );
            return redirect('dashboard/profile/password')->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('dashboard/profile/password')->with('danger', 'El elemento no existe.');
        }
    }
}
