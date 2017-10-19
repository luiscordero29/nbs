@extends('layouts.dashboard')
@section('title', 'Ver Recompensa')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Recompensa</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/tests/index">Recompensas</a></li>
            <li class="breadcrumb-item active">Ver Recompensa </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/tests/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
        </div>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Recompensa</h4>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <b>Fecha: </b>
                    @php
                        $date_array = explode('-',$data['row']->test_date);
                        $date_array = array_reverse($date_array);   
                        $date    = date(implode('/', $date_array));
                        echo $date;
                    @endphp
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <b>Número ID: </b>{{ $data['row']->user->user_number_id }}
                </div>
                <div class="col-6">
                    <b>Número de Empleado: </b>{{ $data['row']->user->user_number_employee }}
                </div>
                <div class="col-6">
                    <b>Apellidos: </b>{{ $data['row']->user->user_firstname }}
                </div>
                <div class="col-6">
                    <b>Nombres: </b>{{ $data['row']->user->user_lastname }}
                </div>
                <div class="col-4">
                    <b>Tipo: </b>{{ $data['row']->user->user_type_description }}
                </div> 
                <div class="col-4">
                    <b>División: </b>{{ $data['row']->user->user_division_description }}
                </div> 
                <div class="col-4">
                    <b>Cargo: </b>{{ $data['row']->user->user_position_description }}
                </div>   
                <div class="col-8">
                    <b>E-mail: </b>{{ $data['row']->user->email }}<br />
                </div>
                <div class="col-4">
                    <b>Rol: </b>{{ $data['row']->user->rol_description }}<br />
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <b>Nombre:</b> {{ $data['row']->reward->reward_name }}
                </div>
                <div class="col-2">
                    <b>Crédito:</b> {{ $data['row']->reward->reward_ammount }}
                </div>
            </div>
        </div>
    </div>
@endsection