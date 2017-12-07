<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use App\Reward;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class TestsController extends Controller
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
        $data['subitem'] = 'tests/index';
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
       $data['rows'] = DB::table('tests')
            ->join('users', 'users.user_uid', '=', 'tests.user_uid')
            ->join('rewards', 'rewards.reward_uid', '=', 'tests.reward_uid')
            ->where('tests.test_ammount', 'like', '%'.$search.'%')
            ->orWhere('users.user_firstname', 'like', '%'.$search.'%')
            ->orWhere('users.user_lastname', 'like', '%'.$search.'%')            
            ->orWhere('users.user_number_id', 'like', '%'.$search.'%')            
            ->orWhere('users.user_number_employee', 'like', '%'.$search.'%')            
            ->orWhere('rewards.reward_name', 'like', '%'.$search.'%')            
            ->paginate(30);
        # View
        return view('tests.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'tests/index';
        # View 
        $data['today'] = date("Y-m-d");
        $data['users'] = User::get();
        $data['rewards'] = Reward::where('reward_status','1')->get();
        return view('tests.create', ['data' => $data]);
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
            'test_user_uid' => 'required',
            'test_reward_uid' => 'required',
            'test_status' => 'required',
            'test_date' => 'required',
        ]);
        # Request
        $reward = Reward::where('reward_uid', $request->input('test_reward_uid'))->first();
        $test_ammount = $reward->reward_ammount;
        $test_date = $request->input('test_date');
        $date_array = explode('/',$test_date);
        $date_array = array_reverse($date_array);
        $test_date = date(implode('-', $date_array));   
        $reward_uid = $reward->reward_uid;
        $user_uid = $request->input('test_user_uid');
        $test_status = $request->input('test_status');
        $test_uid = Uuid::generate()->string;
        # Insert
        $test = new Test;
        $test->test_ammount = $test_ammount;
        $test->test_date = $test_date;
        $test->reward_uid = $reward_uid;
        $test->test_status = $test_status;
        $test->user_uid = $user_uid;
        $test->test_uid  = $test_uid;
        $test->save();
        return redirect('tests/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($test_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'tests/index';
        $count = Test::where('test_uid', $test_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = 
                Test::where('test_uid', $test_uid)->first();
            return view('tests.show', ['data' => $data]);
        }else{
            # Error
            return redirect('tests/index')->with('info', 'No se puede Ver el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($test_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'tests/index';
        $count = Test::where('test_uid', $test_uid)->count();
        if ($count>0) {
            # Edit
            $data['users'] = User::get();
            $data['rewards'] = Reward::where('reward_status','1')->get();
            $data['row'] = Test::where('test_uid', $test_uid)->first();
            return view('tests.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('tests/index')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $test_uid)
    {
        # Rules
        $this->validate($request, [
            'test_user_uid' => 'required',
            'test_reward_uid' => 'required',
            'test_status' => 'required',
            'test_date' => 'required',
        ]);
        # Request
        $reward = Reward::where('reward_uid', $request->input('test_reward_uid'))->first();
        $test_ammount = $reward->reward_ammount;
        $test_date = $request->input('test_date');
        $date_array = explode('/',$test_date);
        $date_array = array_reverse($date_array);
        $test_date = date(implode('-', $date_array));   
        $reward_uid = $reward->reward_uid;
        $user_uid = $request->input('test_user_uid');
        $test_status = $request->input('test_status');
        # Update
        $test = Test::where('test_uid', $test_uid)->first();
        $test->test_ammount = $test_ammount;
        $test->test_date = $test_date;
        $test->reward_uid = $reward_uid;
        $test->user_uid = $user_uid;
        $test->test_status = $test_status;
        $test->save();
        return redirect('tests/edit/'.$test_uid)->with('success', 'Registro Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($test_uid)
    {
        $count = Test::where('test_uid', $test_uid)->count();
        if ($count>0) {
            # delete
            Test::where('test_uid', $test_uid)->delete();
            return redirect('rewards/index')->with('success', 'Registro Elimino');
        }else{
            return redirect('tests/index')->with('info', 'No se puede Eliminar el registro');
        }
    }
}
