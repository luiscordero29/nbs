<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $data = DB::table('users_positions')->where('user_position_description', 'like', '%'.$search.'%')->paginate(30);
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
        return view('users_positions.create');
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
        # Insert
        DB::table('users_positions')->insert(
            ['user_position_description' => $user_position_description]
        );
        return redirect('users_positions/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_position_id)
    {
        $data = DB::table('users_positions')->where('user_position_id', '=', $user_position_id)->first();
        return view('users_positions.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_position_id)
    {
        $data = DB::table('users_positions')->where('user_position_id', '=', $user_position_id)->first();
        return view('users_positions.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_position_id)
    {
        # Rules
        $this->validate($request, [
            'user_position_description' => 'required|max:60',
        ]);
        # Request
        $user_position_id = $request->input('user_position_id');
        $user_position_description = $request->input('user_position_description');
        # Unique 
        $count = DB::table('users_positions')->where('user_position_description', $user_position_description)->where('user_position_id', '<>', $user_position_id)->count();
        if ($count<1) {
            # Update
            DB::table('users_positions')
                ->where('user_position_id', $user_position_id)
                ->update(['user_position_description' => $user_position_description]);
            return redirect('users_positions/edit/'.$user_position_id)->with('success', 'Registro Actualizado');
        }else{
            # Update
            return redirect('users_positions/edit/'.$user_position_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_position_id)
    {
        $data = DB::table('users_positions')->where('user_position_id', '=', $user_position_id)->first();
        if (!empty($data->user_position_id)) {
            # delete
            DB::table('users_positions')->where('user_position_id', '=', $user_position_id)->delete();
            return redirect('users_positions/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('users_positions/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
