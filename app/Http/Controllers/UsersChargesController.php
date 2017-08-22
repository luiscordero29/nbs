<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersChargesController extends Controller
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
        $data = DB::table('users_charges')->where('user_charge_description', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('users_charges.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users_charges.create');
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
            'user_charge_description' => 'required|max:60|unique:users_charges,user_charge_description',
        ]);
        # Request
        $user_charge_description = $request->input('user_charge_description');
        # Insert
        DB::table('users_charges')->insert(
            ['user_charge_description' => $user_charge_description]
        );
        return redirect('users_charges/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_charge_id)
    {
        $data = DB::table('users_charges')->where('user_charge_id', '=', $user_charge_id)->first();
        return view('users_charges.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_charge_id)
    {
        $data = DB::table('users_charges')->where('user_charge_id', '=', $user_charge_id)->first();
        return view('users_charges.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_charge_id)
    {
        # Rules
        $this->validate($request, [
            'user_charge_description' => 'required|max:60',
        ]);
        # Request
        $user_charge_id = $request->input('user_charge_id');
        $user_charge_description = $request->input('user_charge_description');
        # Unique 
        $count = DB::table('users_charges')->where('user_charge_description', $user_charge_description)->where('user_charge_id', '<>', $user_charge_id)->count();
        if ($count<1) {
            # Update
            DB::table('users_charges')
                ->where('user_charge_id', $user_charge_id)
                ->update(['user_charge_description' => $user_charge_description]);
            return redirect('users_charges/edit/'.$user_charge_id)->with('success', 'Registro Actualizado');
        }else{
            # Update
            return redirect('users_charges/edit/'.$user_charge_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_charge_id)
    {
        $data = DB::table('users_charges')->where('user_charge_id', '=', $user_charge_id)->first();
        if (!empty($data->user_charge_id)) {
            # delete
            DB::table('users_charges')->where('user_charge_id', '=', $user_charge_id)->delete();
            return redirect('users_charges/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('users_charges/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
