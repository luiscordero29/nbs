<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Test;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsReportController extends Controller
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
        $data['subitem'] = 'tests_report/index';
        # Request
        $method = $request->method();
        if ($request->isMethod('post')) {
            #daterange
            $daterange = $request->input('daterange');
            $daterange = explode(" - ", $daterange);
            $date_array = explode('/',$daterange[0]);
            $date_array = array_reverse($date_array);   
            $data['month_first'] = date(implode('-', $date_array));
            $date_array = explode('/',$daterange[1]);
            $date_array = array_reverse($date_array);   
            $data['month_last'] = date(implode('-', $date_array));
            # search 
            $data['search'] = $request->input('search');
            $request->session()->flash('search', $data['search']);
            $request->session()->flash('info', 'Resultado de la busqueda: '.$data['search'] );
        }else{
            # daterange
            $data['month_first'] = date("Y-m-d", strtotime( '-30 days' ));
            $data['month_last'] = date("Y-m-d");
            #search          
            $data['search'] = '';
            $request->session()->forget('info');
            $request->session()->forget('search');
        }      
        $data['rows'] = DB::table('tests')
            ->select(DB::raw('SUM(tests.test_ammount) as test_ammount, users.*'))
            ->groupBy('tests.user_uid')
            ->orderBy('test_ammount', 'desc')
            ->join('users', 'users.user_uid', '=', 'tests.user_uid')
            ->whereBetween('tests.test_date', [$data['month_first'], $data['month_last']])
            ->where('tests.test_status', 1)
            ->where(function ($query) use ($data)  {
                $query->where('user_firstname', 'like', '%'.$data['search'].'%')
                    ->orWhere('user_lastname', 'like', '%'.$data['search'].'%')
                    ->orWhere('user_number_id', 'like', '%'.$data['search'].'%')
                    ->orWhere('user_number_employee', 'like', '%'.$data['search'].'%');
            })
            ->get();
        # View
        return view('tests_report.index', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($month_first, $month_last, $user_uid)
    {
        # User
        $data['user'] = Auth::user();
        # Menu
        $data['item'] = 'rewards';
        $data['subitem'] = 'tests_report/index';
        # Show
        $count = Test::where('user_uid', $user_uid)->count();
        if ($count>0) {
            # Show
            $data['row'] = User::where('user_uid', $user_uid)->first();
            $data['rows'] = Test::where('user_uid', $user_uid)
                ->whereBetween('test_date', [$month_first, $month_last])
                ->get();
            return view('tests_report.show', ['data' => $data]);
        }else{
            # Error
            return redirect('tests_report/index')->with('info', 'No se puede Ver el registro');
        }
    }
}
