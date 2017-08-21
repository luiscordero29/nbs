<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class VehiclesBrandsController extends Controller
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
        $data = DB::table('vehicles_brands')
            ->where('vehicle_brand_name', 'like', '%'.$search.'%')
            ->orWhere('vehicle_brand_description', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('vehicles_brands.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('vehicles_brands.create');
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
            'vehicle_brand_name' => 'required|max:60|unique:vehicles_brands,vehicle_brand_name',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        if ($request->hasFile('vehicle_brand_logo')) {
            $extension = $request->file('vehicle_brand_logo')->extension();
            $vehicle_brand_logo = $vehicle_brand_name.'.'.$extension;
            $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
            # Insert
            DB::table('vehicles_brands')->insert(
                [
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_brand_description' => $vehicle_brand_description,
                    'vehicle_brand_logo' => $vehicle_brand_logo,
                ]
            );
        }else{
            # Insert
            DB::table('vehicles_brands')->insert(
                [
                    'vehicle_brand_name' => $vehicle_brand_name,
                    'vehicle_brand_description' => $vehicle_brand_description,
                ]
            );
        }
        return redirect('vehicles_brands/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_brand_id)
    {
        $data = DB::table('vehicles_brands')->where('vehicle_brand_id', '=', $vehicle_brand_id)->first();
        return view('vehicles_brands.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_brand_id)
    {
        $data = DB::table('vehicles_brands')->where('vehicle_brand_id', '=', $vehicle_brand_id)->first();
        return view('vehicles_brands.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_brand_id)
    {
        # Rules
        $this->validate($request, [
            'vehicle_brand_name' => 'required|max:60',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_brand_id = $request->input('vehicle_brand_id');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        # Unique 
        $count = DB::table('vehicles_brands')->where('vehicle_brand_name', $vehicle_brand_name)->where('vehicle_brand_id', '<>', $vehicle_brand_id)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_brand_logo')) {
                $extension = $request->file('vehicle_brand_logo')->extension();
                $vehicle_brand_logo = $vehicle_brand_name.'.'.$extension;
                $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
                # Update
                DB::table('vehicles_brands')
                    ->where('vehicle_brand_id', $vehicle_brand_id)
                    ->update(
                        [
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_brand_description' => $vehicle_brand_description,
                            'vehicle_brand_logo' => $vehicle_brand_logo,
                        ]
                    );
            }else{
                # Update
                DB::table('vehicles_brands')
                    ->where('vehicle_brand_id', $vehicle_brand_id)
                    ->update(
                        [
                            'vehicle_brand_name' => $vehicle_brand_name,
                            'vehicle_brand_description' => $vehicle_brand_description,
                        ]
                    );
            }
            return redirect('vehicles_brands/edit/'.$vehicle_brand_id)->with('success', 'Registro Actualizado');
        }else{
            # Update
            return redirect('vehicles_brands/edit/'.$vehicle_brand_id)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_brand_id)
    {
        $data = DB::table('vehicles_brands')->where('vehicle_brand_id', '=', $vehicle_brand_id)->first();
        if (!empty($data->vehicle_brand_id)) {
            # delete
            Storage::delete($data->vehicle_brand_logo);
            DB::table('vehicles_brands')->where('vehicle_brand_id', '=', $vehicle_brand_id)->delete();
            return redirect('vehicles_brands/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('vehicles_brands/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
