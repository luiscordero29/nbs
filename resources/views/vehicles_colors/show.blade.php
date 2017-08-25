@extends('layouts.dashboard')
@section('title', 'Ver Color')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Color</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_colors/index">Colores de Vehiculos</a></li>
            <li class="breadcrumb-item active">Ver Color </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_colors/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Color</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data->vehicle_color_id }} <br />
        <b>Color:</b> {{ $data->vehicle_color_name }} <br /> 
    </p>
@endsection