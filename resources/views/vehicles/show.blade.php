@extends('layouts.dashboard')
@section('title', 'Ver Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicles/index') }}">Vehiculos</a></li>
            <li class="breadcrumb-item active">Ver Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/vehicles/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Datos del Empleado</h4>
    @if ($data['row']->user_image)
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-6">
                        <b>Número ID: </b>{{ $data['row']->user_number_id }}
                    </div>
                    <div class="col-6">
                        <b>Número de Empleado: </b>{{ $data['row']->user_number_employee }}
                    </div>
                    <div class="col-6">
                        <b>Apellidos: </b>{{ $data['row']->user_firstname }}
                    </div>
                    <div class="col-6">
                        <b>Nombres: </b>{{ $data['row']->user_lastname }}
                    </div>
                    <div class="col-4">
                        <b>Tipo: </b>{{ $data['row']->user_type_description }}
                    </div> 
                    <div class="col-4">
                        <b>División: </b>{{ $data['row']->user_division_description }}
                    </div> 
                    <div class="col-4">
                        <b>Cargo: </b>{{ $data['row']->user_position_description }}
                    </div>   
                    <div class="col-12">
                        <b>E-mail: </b>{{ $data['row']->email }}<br />
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="{{ asset( 'storage/' . $data['row']->user_image) }}" class="img-responsive" >                                
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <b>Número ID: </b>{{ $data['row']->user_number_id }}
                    </div>
                    <div class="col-6">
                        <b>Número de Empleado: </b>{{ $data['row']->user_number_employee }}
                    </div>
                    <div class="col-6">
                        <b>Apellidos: </b>{{ $data['row']->user_firstname }}
                    </div>
                    <div class="col-6">
                        <b>Nombres: </b>{{ $data['row']->user_lastname }}
                    </div>
                    <div class="col-4">
                        <b>Tipo: </b>{{ $data['row']->user_type_description }}
                    </div> 
                    <div class="col-4">
                        <b>División: </b>{{ $data['row']->user_division_description }}
                    </div> 
                    <div class="col-4">
                        <b>Cargo: </b>{{ $data['row']->user_position_description }}
                    </div>   
                    <div class="col-12">
                        <b>E-mail: </b>{{ $data['row']->email }}<br />
                    </div>
                </div>
            </div>
        </div>
    @endif
    <br />
    <h4 class="card-title">Datos del Vehiculo</h4>
    @if ($data['row']->vehicle_image)
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-4">
                        <b>Tipo: </b>{{ $data['row']->vehicle_type_name }}
                    </div>
                    <div class="col-4">
                        <b>Marca: </b>{{ $data['row']->vehicle_brand_name }}
                    </div>
                    <div class="col-4">
                        <b>Modelo: </b>{{ $data['row']->vehicle_model_name }}
                    </div>
                    <div class="col-12">
                        <b>Apodo: </b>{{ $data['row']->vehicle_name }}
                    </div>
                    <div class="col-3">
                        <b>Pico y Placa: </b>
                        @if($data['row']->vehicle_status == 'does not apply')
                            NO APLICA
                        @elseif ($data['row']->vehicle_status == 'even')
                            PAR
                        @else
                            IMPAR
                        @endif
                    </div>
                    <div class="col-3">
                        <b>Placa: </b>{{ $data['row']->vehicle_code }}
                    </div> 
                    <div class="col-3">
                        <b>Año: </b>{{ $data['row']->vehicle_year }}
                    </div> 
                    <div class="col-3">
                        <b>Color: </b>{{ $data['row']->vehicle_color_name }}
                    </div>
                </div>
            </div>
            <div class="col-2">
                <img src="{{ asset( 'storage/' . $data['row']->vehicle_image) }}" class="img-responsive" >                                
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <b>Tipo: </b>{{ $data['row']->vehicle_type_name }}
                    </div>
                    <div class="col-4">
                        <b>Marca: </b>{{ $data['row']->vehicle_brand_name }}
                    </div>
                    <div class="col-4">
                        <b>Modelo: </b>{{ $data['row']->vehicle_model_name }}
                    </div>
                    <div class="col-12">
                        <b>Apodo: </b>{{ $data['row']->vehicle_name }}
                    </div>
                    <div class="col-3">
                        <b>Pico y Placa: </b>
                        @if($data['row']->vehicle_status == 'does not apply')
                            NO APLICA
                        @elseif ($data['row']->vehicle_status == 'even')
                            PAR
                        @else
                            IMPAR
                        @endif
                    </div>
                    <div class="col-3">
                        <b>Placa: </b>{{ $data['row']->vehicle_code }}
                    </div> 
                    <div class="col-3">
                        <b>Año: </b>{{ $data['row']->vehicle_year }}
                    </div> 
                    <div class="col-3">
                        <b>Color: </b>{{ $data['row']->vehicle_color_name }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection