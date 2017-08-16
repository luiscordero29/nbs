<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

class TypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        session('active', 'types');
        session('menu_configuraciones', 'true');
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
        $data = DB::table('types')->where('type_description', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('types.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->flash('active', 'types');
        return view('types.create');
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
            'type_description' => 'required|max:60|unique:types,type_description',
        ]);
        # Request
        $type_description = $request->input('type_description');
        # Insert
        $id = DB::table('types')->insertGetId(
            ['type_description' => $type_description]
        );
        return redirect('types/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type_id)
    {
        $data = DB::table('types')->where('type_id', '=', $type_id)->first();
        return view('types.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type_id)
    {
        $data = DB::table('types')->where('type_id', '=', $type_id)->first();
        return view('types.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type_id)
    {
        # Rules
        $this->validate($request, [
            'type_description' => 'required|max:60',
        ]);
        # Request
        $type_id = $request->input('type_id');
        $type_description = $request->input('type_description');
        # Unique 
        $count = DB::table('types')->where('type_description', $type_description)->where('type_id', '<>', $type_id)->count();
        if ($count<1) {
            # Update
            $id = DB::table('types')
                ->where('type_id', $type_id)
                ->update(['type_description' => $type_description]);
            return redirect('types/edit/'.$type_id)->with('success', 'Registro Actualizado');
        }else{
            # Update
            return redirect('types/edit/'.$type_id)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type_id)
    {
        $data = DB::table('types')->where('type_id', '=', $type_id)->first();
        if (!empty($data->type_id)) {
            # delete
            DB::table('types')->where('type_id', '=', $type_id)->delete();
            return redirect('types/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('types/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
