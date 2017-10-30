@extends('layouts.dashboard')
@section('title', 'Ver Modelo de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_models/index">Vehiculos Modelos</a></li>
            <li class="breadcrumb-item active">Ver Modelo de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_brands/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Modelo de Vehiculo</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->vehicle_model_id }} <br />
        <b>Tipo:</b> {{ $data['row']->vehicle_brand->vehicle_type->vehicle_type_name }} <br />
        <b>Marca:</b> {{ $data['row']->vehicle_brand->vehicle_brand_name }} <br />
        <b>Nombre del Modelo:</b> {{ $data['row']->vehicle_model_name }} <br />
        <b>Descripción del Modelo:</b> {{ $data['row']->vehicle_model_description }} <br />
    </p>
@endsection