<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class UsersTypesController extends Controller
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
        $data['subitem'] = 'users_types/index';
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
        $data['rows'] = UserType::where('user_type_description', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('users_types.index', ['data' => $data]);
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
        $data['subitem'] = 'users_types/index';
        # View
        return view('users_types.create', ['data' => $data]);
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
            'user_type_description' => 'required|max:60|unique:users_types,user_type_description',
        ]);
        # Request
        $user_type_description = $request->input('user_type_description');
        $user_type_uid = Uuid::generate()->string;
        # Insert
        $user_type = new UserType;
        $user_type->user_type_description = $user_type_description;
        $user_type->user_type_uid  = $user_type_uid;
        $user_type->save();
        return redirect('users_types/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_type_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users_types/index';
        $count = UserType::where('user_type_uid', $user_type_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = UserType::where('user_type_uid', $user_type_uid)->first();
            return view('users_types.show', ['data' => $data]);
        }else{
            # Error
            return redirect('users_types/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_type_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users_types/index';
        $count = UserType::where('user_type_uid', $user_type_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = UserType::where('user_type_uid', $user_type_uid)->first();
            return view('users_types.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('users_types/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_type_uid)
    {
        # Rules
        $this->validate($request, [
            'user_type_description' => 'required|max:60',
        ]);
        # Request
        $user_type_description = $request->input('user_type_description');
        # Unique 
        $count = UserType::where('user_type_description', $user_type_description)->where('user_type_uid', '<>', $user_type_uid)->count();
        if ($count<1) {
            # Update
            $user_type = UserType::where('user_type_uid', $user_type_uid)->first();
            $user_type->user_type_description = $user_type_description;
            $user_type->save();
            return redirect('users_types/edit/'.$user_type_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('users_types/edit/'.$user_type_uid)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_type_uid)
    {
        $count = UserType::where('user_type_uid', $user_type_uid)->count();
        if ($count>0) {
            # Delete
            UserType::where('user_type_uid', '=', $user_type_uid)->delete();
            return redirect('users_types/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('users_types/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
