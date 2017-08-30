@extends('layouts.dashboard')
@section('title', 'Ver Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/user_vehicles/index">Vehiculos</a></li>
            <li class="breadcrumb-item active">Ver Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/user_vehicles/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
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
                        @if($data['row']->vehicle_status == 'yes')
                            SI
                        @else
                            NO
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
                        @if($data['row']->vehicle_status == 'yes')
                            SI
                        @else
                            NO
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