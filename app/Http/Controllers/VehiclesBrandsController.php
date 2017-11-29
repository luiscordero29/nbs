<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\VehicleType;
use App\VehicleBrand;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

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
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_brands/index';
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
        $data['rows'] = DB::table('vehicles_brands')
            ->join('vehicles_types', 'vehicles_types.vehicle_type_uid', '=', 'vehicles_brands.vehicle_type_uid')
            ->where('vehicles_types.vehicle_type_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_brands.vehicle_brand_name', 'like', '%'.$search.'%')
            ->orWhere('vehicles_brands.vehicle_brand_description', 'like', '%'.$search.'%')
            ->paginate(30);
        # View
        return view('banks.index', ['data' => $data]);
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
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_brands/index';
        # View 
        $data['vehicles_types'] = VehicleType::get();
        return view('vehicles_brands.create', ['data' => $data]);
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
            'vehicle_type_uid' => 'required',
            'vehicle_brand_name' => 'required|max:60|unique:vehicles_brands,vehicle_brand_name',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        $vehicle_brand_uid = Uuid::generate()->string;
        if ($request->hasFile('vehicle_brand_logo')) {
            $extension = $request->file('vehicle_brand_logo')->extension();
            $vehicle_brand_logo = $vehicle_brand_uid.'.'.$extension;
            $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
            # Insert
            $vehicle_brand = new VehicleBrand;
            $vehicle_brand->vehicle_type_uid = $vehicle_type_uid;
            $vehicle_brand->vehicle_brand_name  = $vehicle_brand_name;
            $vehicle_brand->vehicle_brand_description  = $vehicle_brand_description;
            $vehicle_brand->vehicle_brand_logo  = $vehicle_brand_logo;
            $vehicle_brand->vehicle_brand_uid  = $vehicle_brand_uid;
            $vehicle_brand->save();
        }else{
            # Insert
            $vehicle_brand = new VehicleBrand;
            $vehicle_brand->vehicle_type_uid = $vehicle_type_uid;
            $vehicle_brand->vehicle_brand_name  = $vehicle_brand_name;
            $vehicle_brand->vehicle_brand_description  = $vehicle_brand_description;
            $vehicle_brand->vehicle_brand_uid  = $vehicle_brand_uid;
            $vehicle_brand->save();
        }
        return redirect('vehicles_brands/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vehicle_brand_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_brands/index';
        $count = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->first();
            return view('vehicles_brands.show', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_brands/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle_brand_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'vehicles';
        $data['subitem'] = 'vehicles_brands/index';
        $count = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->count();
        if ($count>0) {
            # Edit 
            $data['vehicles_types'] = VehicleType::get();
            $data['row'] = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->first();
            return view('vehicles_brands.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('vehicles_brands/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle_brand_uid)
    {
        # Rules
        $this->validate($request, [
            'vehicle_type_uid' => 'required',
            'vehicle_brand_name' => 'required|max:60',
            'vehicle_brand_logo' => 'image|mimes:jpeg,png',
        ]);
        # Request
        $vehicle_type_uid = $request->input('vehicle_type_uid');
        $vehicle_brand_uid = $request->input('vehicle_brand_uid');
        $vehicle_brand_name = $request->input('vehicle_brand_name');
        $vehicle_brand_description = $request->input('vehicle_brand_description');
        # Unique 
        $count = VehicleBrand::where('vehicle_brand_name', $vehicle_brand_name)->where('vehicle_brand_uid', '<>', $vehicle_brand_uid)->count();
        if ($count<1) {
            if ($request->hasFile('vehicle_brand_logo')) {
                $extension = $request->file('vehicle_brand_logo')->extension();
                $vehicle_brand_logo = $vehicle_brand_uid.'.'.$extension;
                $request->vehicle_brand_logo->storeAs('public', $vehicle_brand_logo);
                # Update
                $vehicle_brand = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->first();
                $vehicle_brand->vehicle_type_uid = $vehicle_type_uid;
                $vehicle_brand->vehicle_brand_name  = $vehicle_brand_name;
                $vehicle_brand->vehicle_brand_description  = $vehicle_brand_description;
                $vehicle_brand->vehicle_brand_logo  = $vehicle_brand_logo;
                $vehicle_brand->vehicle_brand_uid  = $vehicle_brand_uid;
                $vehicle_brand->save();
            }else{
                # Update
                $vehicle_brand = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->first();
                $vehicle_brand->vehicle_type_uid = $vehicle_type_uid;
                $vehicle_brand->vehicle_brand_name  = $vehicle_brand_name;
                $vehicle_brand->vehicle_brand_description  = $vehicle_brand_description;
                $vehicle_brand->vehicle_brand_uid  = $vehicle_brand_uid;
                $vehicle_brand->save();
            }
            return redirect('vehicles_brands/edit/'.$vehicle_brand_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('vehicles_brands/edit/'.$vehicle_brand_uid)->with('danger', 'El elemento marca ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehicle_brand_uid)
    {
        $count = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->count();
        if ($count>0) {
            # Delete
            $data = VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->first();
            Storage::delete($data->vehicle_brand_logo);
            VehicleBrand::where('vehicle_brand_uid', $vehicle_brand_uid)->delete();
            return redirect('vehicles_brands/index')->with('success', 'Registro Elimino');
        }else{
            # Error
            return redirect('vehicles_brands/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
