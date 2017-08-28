<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class RolesController extends Controller
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
        $data['rows'] = DB::table('roles')
            ->where('rol_name', 'like', '%'.$search.'%')
            ->orWhere('rol_description', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('roles.index', ['data' => $data]);
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
        # View
        return view('roles.create', ['data' => $data]);
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
            'rol_name' => 'required|max:60|unique:roles,rol_name',
            'rol_description' => 'required',
        ]);
        # Request
        $rol_name = $request->input('rol_name');
        $rol_description = $request->input('rol_description');
        # Insert
        DB::table('roles')->insert(
            [
                'rol_name' => $rol_name,
                'rol_description' => $rol_description,
                'rol_protected' => 'no',
            ]
        );
        return redirect('roles/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rol_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('roles')->where('rol_id', '=', $rol_id)->count();
        if ($count>0) {
            # Show
            $data['row'] = DB::table('roles')->where('rol_id', '=', $rol_id)->first();
            return view('roles.show', ['data' => $data]);
        }else{
            # Error
            return redirect('roles/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($rol_id)
    {
        # User
        $data['user'] = Auth::user();
        $count = DB::table('roles')->where('rol_id', '=', $rol_id)->count();
        if ($count>0) {
            $data['row'] = DB::table('roles')
                ->where('rol_id', '=', $rol_id)
                ->where('rol_protected', '=', 'no')
                ->first();
            return view('roles.edit', ['data' => $data]);
        }else{
            return redirect('roles/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rol_id)
    {
        # Rules
        $this->validate($request, [
            'rol_name' => 'required|max:60',
            'rol_description' => 'required',
        ]);
        # Request
        $rol_id = $request->input('rol_id');
        $rol_name = $request->input('rol_name');
        $rol_description = $request->input('rol_description');
        # Unique 
        $count = DB::table('roles')->where('rol_protected', '=', 'no')->where('rol_name', $rol_name)->where('rol_id', '<>', $rol_id)->count();
        if ($count<1) {        
            # Update
            DB::table('roles')
                ->where('rol_id', $rol_id)
                ->update(
                    [
                        'rol_name' => $rol_name,
                        'rol_description' => $rol_description,
                        'rol_protected' => 'no',
                    ]
                );
            return redirect('roles/edit/'.$rol_id)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('roles/edit/'.$rol_id)->with('danger', 'El elemento tipo ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rol_id)
    {
        $count = DB::table('roles')->where('rol_id', '=', $rol_id)->count();
        if ($count>0) {
            # delete
            DB::table('roles')->where('rol_id', '=', $rol_id)->delete();
            return redirect('roles/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('roles/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
