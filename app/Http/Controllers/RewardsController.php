<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rewards;
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
            $request->session()->forget('info');
            $request->session()->forget('search');
        }
        $data['rows'] = Rewards::where('reward_name', 'like', '%'.$search.'%')->paginate(30);
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
        ]);
        # Request
        $reward_name = $request->input('reward_name');
        $reward_ammount = $request->input('reward_ammount');
        $reward_description = $request->input('reward_description');
        $reward_uid = Uuid::generate()->string;
        # Insert
        $reward = new Rewards;
        $reward->reward_name = $reward_name;
        $reward->reward_ammount = $reward_ammount;
        $reward->reward_description = $reward_description;
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
        $count = Rewards::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = 
                Rewards::where('reward_uid', $reward_uid)->first();
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
        $count = Rewards::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # Edit
            $data['row'] = Rewards::where('reward_uid', $reward_uid)->first();
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
        ]);
        # Request
        $reward_name = $request->input('reward_name');
        $reward_ammount = $request->input('reward_ammount');
        $reward_description = $request->input('reward_description');
        # Unique 
        $count = Rewards::where('reward_name', $reward_name)->where('reward_uid', '<>', $reward_uid)->count();
        if ($count<1) {
            # Update
            $reward = Rewards::where('reward_uid', $reward_uid)->first();
            $reward->reward_name = $reward_name;
        $reward->reward_ammount = $reward_ammount;
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
        $count = Rewards::where('reward_uid', $reward_uid)->count();
        if ($count>0) {
            # delete
            Rewards::where('reward_uid', $reward_uid)->delete();
            return redirect('rewards/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('rewards/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
