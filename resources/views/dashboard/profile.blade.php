@extends('layouts.dashboard')
@section('title', 'Mis Datos')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Mis Datos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Mis Datos </li>
        </ol>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Mis Datos</h4>
    <div class="row">
        @if ($data['user']->user_image)
        <div class="col-10">
            <div class="row">
                <div class="col-6">
                    <b>Número ID: </b>{{ $data['user']->user_number_id }}
                </div>
                <div class="col-6">
                    <b>Número de Empleado: </b>{{ $data['user']->user_number_employee }}
                </div>
                <div class="col-6">
                    <b>Apellidos: </b>{{ $data['user']->user_firstname }}
                </div>
                <div class="col-6">
                    <b>Nombres: </b>{{ $data['user']->user_lastname }}
                </div>
                <div class="col-4">
                    <b>Tipo: </b>{{ $data['user']->user_type_description }}
                </div> 
                <div class="col-4">
                    <b>División: </b>{{ $data['user']->user_division_description }}
                </div> 
                <div class="col-4">
                    <b>Cargo: </b>{{ $data['user']->user_position_description }}
                </div>   
                <div class="col-12">
                    <b>E-mail: </b>{{ $data['user']->email }}<br />
                </div>
            </div>
        </div>
        <div class="col-2">
            <img src="{{ asset( 'storage/' . $data['user']->user_image) }}" class="img-responsive" >                                
        </div>
        @else
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <b>Número ID: </b>{{ $data['user']->user_number_id }}
                </div>
                <div class="col-6">
                    <b>Número de Empleado: </b>{{ $data['user']->user_number_employee }}
                </div>
                <div class="col-6">
                    <b>Apellidos: </b>{{ $data['user']->user_firstname }}
                </div>
                <div class="col-6">
                    <b>Nombres: </b>{{ $data['user']->user_lastname }}
                </div>
                <div class="col-4">
                    <b>Tipo: </b>{{ $data['user']->user_type_description }}
                </div> 
                <div class="col-4">
                    <b>División: </b>{{ $data['user']->user_division_description }}
                </div> 
                <div class="col-4">
                    <b>Cargo: </b>{{ $data['user']->user_position_description }}
                </div>   
                <div class="col-12">
                    <b>E-mail: </b>{{ $data['user']->email }}<br />
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection