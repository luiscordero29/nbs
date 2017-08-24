@extends('layouts.dashboard')
@section('title', 'Ver Usuario')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Usuario</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Gestor de Usuarios</a></li>
            <li class="breadcrumb-item active">Ver Usuario </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Usuario</h4>
    <div class="row">
        @if ($data->user_image)
        <div class="col-10">
            <div class="row">
                <div class="col-6">
                    <b>Número ID: </b>{{ $data->user_number_id }}
                </div>
                <div class="col-6">
                    <b>Número de Empleado: </b>{{ $data->user_number_employee }}
                </div>
                <div class="col-6">
                    <b>Apellidos: </b>{{ $data->user_firstname }}
                </div>
                <div class="col-6">
                    <b>Nombres: </b>{{ $data->user_lastname }}
                </div>
                <div class="col-4">
                    <b>Tipo: </b>{{ $data->user_type_description }}
                </div> 
                <div class="col-4">
                    <b>División: </b>{{ $data->user_division_description }}
                </div> 
                <div class="col-4">
                    <b>Cargo: </b>{{ $data->user_position_description }}
                </div>   
                <div class="col-8">
                    <b>E-mail: </b>{{ $data->email }}<br />
                </div>
                <div class="col-4">
                    <b>Rol: </b>{{ $data->rol_description }}<br />
                </div>
            </div>
        </div>
        <div class="col-2">
            <img src="{{ asset( 'storage/' . $data->user_image) }}" class="img-responsive" >                                
        </div>
        @else
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <b>Número ID: </b>{{ $data->user_number_id }}
                </div>
                <div class="col-6">
                    <b>Número de Empleado: </b>{{ $data->user_number_employee }}
                </div>
                <div class="col-6">
                    <b>Apellidos: </b>{{ $data->user_firstname }}
                </div>
                <div class="col-6">
                    <b>Nombres: </b>{{ $data->user_lastname }}
                </div>
                <div class="col-4">
                    <b>Tipo: </b>{{ $data->user_type_description }}
                </div> 
                <div class="col-4">
                    <b>División: </b>{{ $data->user_division_description }}
                </div> 
                <div class="col-4">
                    <b>Cargo: </b>{{ $data->user_position_description }}
                </div>   
                <div class="col-8">
                    <b>E-mail: </b>{{ $data->email }}<br />
                </div>
                <div class="col-4">
                    <b>Rol: </b>{{ $data->rol_description }}<br />
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection