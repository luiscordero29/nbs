<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class UsersPositionsController extends Controller
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
        $data['subitem'] = 'users_positions/index';
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
        $data['rows'] = UserPosition::where('user_position_description', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('users_positions.index', ['data' => $data]);
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
        $data['subitem'] = 'users_positions/index';
        # View
        return view('users_positions.create', ['data' => $data]);
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
            'user_position_description' => 'required|max:60|unique:users_positions,user_position_description',
        ]);
        # Request
        $user_position_description = $request->input('user_position_description');
        $user_position_uid = Uuid::generate()->string;
        # Insert
        $user_position = New UserPosition;
        $user_position->user_position_description = $user_position_description;
        $user_position->user_position_uid = $user_position_uid;
        $user_position->save();
        return redirect('users_positions/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_position_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users_positions/index';
        $count = UserPosition::where('user_position_uid', $user_position_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = UserPosition::where('user_position_uid', $user_position_uid)->first();
            return view('users_positions.show', ['data' => $data]);
        }else{
            # Error
            return redirect('users_positions/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_position_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'users';
        $data['subitem'] = 'users_positions/index';
        $count = UserPosition::where('user_position_uid', $user_position_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = UserPosition::where('user_position_uid', $user_position_uid)->first();
            return view('users_positions.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('users_positions/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_position_uid)
    {
        # Rules
        $this->validate($request, [
            'user_position_description' => 'required|max:60',
        ]);
        # Request
        $user_position_uid = $request->input('user_position_uid');
        $user_position_description = $request->input('user_position_description');
        # Unique 
        $count = UserPosition::where('user_position_description', $user_position_description)->where('user_position_uid', '<>', $user_position_uid)->count();
        if ($count<1) {
            # Update
            $user_position = UserPosition::where('user_position_uid', $user_position_uid)->first();
            $user_position->user_position_description = $user_position_description;
            $user_position->save();
            return redirect('users_positions/edit/'.$user_position_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('users_positions/edit/'.$user_position_uid)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_position_uid)
    {
        $count = UserPosition::where('user_position_uid', $user_position_uid)->count();
        if ($count>0) {
            # Delete
            UserPosition::where('user_position_uid', $user_position_uid)->delete();
            return redirect('users_positions/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('users_positions/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
