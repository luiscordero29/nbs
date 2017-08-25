<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersDivisionsController extends Controller
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
        $data['rows'] = DB::table('users_divisions')->where('user_division_description', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('users_divisions.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        # View
        return view('users_divisions.create');
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
            'user_division_description' => 'required|max:60|unique:users_divisions,user_division_description',
        ]);
        # Request
        $user_division_description = $request->input('user_division_description');
        # Insert
        DB::table('users_divisions')->insert(
            ['user_division_description' => $user_division_description]
        );
        return redirect('users_divisions/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_division_id)
    {
        $count = DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->first();
            return view('users_divisions.show', ['data' => $data]);
        }else{
            # Error
            return redirect('users_divisions/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_division_id)
    {
        $count = DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->count();
        if ($count>0) {
            # Edit
            $data['row'] = DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->first();
            return view('users_divisions.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('users_divisions/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_division_id)
    {
        # Rules
        $this->validate($request, [
            'user_division_description' => 'required|max:60',
        ]);
        # Request
        $user_division_id = $request->input('user_division_id');
        $user_division_description = $request->input('user_division_description');
        # Unique 
        $count = DB::table('users_divisions')->where('user_division_description', $user_division_description)->where('user_division_id', '<>', $user_division_id)->count();
        if ($count<1) {
            # Update
            DB::table('users_divisions')
                ->where('user_division_id', $user_division_id)
                ->update(['user_division_description' => $user_division_description]);
            return redirect('users_divisions/edit/'.$user_division_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('users_divisions/edit/'.$user_division_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_division_id)
    {
        $count = DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->count();
        if ($count>0) {
            # Delete
            DB::table('users_divisions')->where('user_division_id', '=', $user_division_id)->delete();
            return redirect('users_divisions/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('users_divisions/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
