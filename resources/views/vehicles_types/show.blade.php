@extends('layouts.dashboard')
@section('title', 'Ver Tipo de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicles_types/index') }}">Vehiculos Tipos</a></li>
            <li class="breadcrumb-item active">Ver Tipo de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/vehicles_types/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Tipo de Vehiculo</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->vehicle_type_id }} <br />
        <b>Marca:</b> {{ $data['row']->vehicle_type_name }} <br /> 
        <b>Descripción:</b> {{ $data['row']->vehicle_type_description }}<br /> 
        <b>Icono:</b> <br /> 
        @if ($data['row']->vehicle_type_icon)
            <img src="{{ asset( 'storage/' . $data['row']->vehicle_type_icon) }}" class="img-responsive" >                                
        @endif
    </p>
@endsection