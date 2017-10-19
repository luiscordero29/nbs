<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class RewardsController extends Controller
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
        $data['item'] = 'rewards';
        $data['subitem'] = 'rewards/index';
        # Request
        $method = $request->method();
        $search = $request->input('search');
        if ($request->isMethod('post')) {
            $request->session()->flash('search', $search);
            $request->session()->flash('info', 'Resultado de la busqueda: '.$search );
        }else{
            $request->session()->forget('search');
            $request->session()->forget('info');
        }
        $data['rows'] = Reward::where('reward_name', 'like', '%'.$search.'%')->paginate(30);
        # View
        return view('rewards.index', ['data' => $data]);
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
        $data['item'] = 'rewards';
        $data['subitem'] = 'rewards/index';
        # View
        return view('rewards.create', ['data' => $data]);
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
            'reward_name' => 'required|max:60|unique:rewards,reward_name',
            'reward_ammount' => 'required|integer',
            'reward_status' => 'required',
        ]);
        # Request
        $reward_name = $request->input('reward_name');
        $reward_ammount = $request->input('reward_ammount');
        $reward_description = $request->input('reward_description');
        $reward_status = $request->input('reward_status');
        $reward_uid = Uuid::generate()->string;
        # Insert
        $reward = new Reward;
        $reward->reward_name = $reward_name;
        $reward->reward_ammount = $reward_ammount;
        $reward->reward_description = $reward_description;
        $reward->reward_status = $reward_status;
        $reward->reward_uid  = $reward_uid;
        $reward->save();
        # Redirect
        return redirect('rewards/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($reward_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'rewards/index';
        $count = Reward::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = 
                Reward::where('reward_uid', $reward_uid)->first();
            return view('rewards.show', ['data' => $data]);
        }else{
            # Error
            return redirect('rewards/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($reward_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'rewards/index';
        $count = Reward::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = Reward::where('reward_uid', $reward_uid)->first();
            return view('rewards.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('rewards/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reward_uid)
    {
        # Rules
        $this->validate($request, [
            'reward_name' => 'required|max:60',
            'reward_ammount' => 'required|integer',
            'reward_status' => 'required',
        ]);
        # Request
        $reward_name = $request->input('reward_name');
        $reward_ammount = $request->input('reward_ammount');
        $reward_status = $request->input('reward_status');
        $reward_description = $request->input('reward_description');
        # Unique 
        $count = Reward::where('reward_name', $reward_name)->where('reward_uid', '<>', $reward_uid)->count();
        if ($count<1) {
            # Update
            $reward = Reward::where('reward_uid', $reward_uid)->first();
            $reward->reward_name = $reward_name;
            $reward->reward_ammount = $reward_ammount;
            $reward->reward_status = $reward_status;
            $reward->reward_description = $reward_description;
            $reward->save();
            return redirect('rewards/edit/'.$reward_uid)->with('success', 'Registro Actualizado');
        }else{
            # Error
            return redirect('rewards/edit/'.$reward_uid)->with('danger', 'El elemento descripción ya está en uso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($reward_uid)
    {
        $count = Reward::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # delete
            Reward::where('reward_uid', $reward_uid)->delete();
            return redirect('rewards/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('rewards/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
