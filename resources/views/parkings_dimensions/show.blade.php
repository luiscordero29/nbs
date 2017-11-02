@extends('layouts.dashboard')
@section('title', 'Ver Dimensión del Parqueadero')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings_dimensions/index">Dimensiones</a></li>
            <li class="breadcrumb-item active">Ver Dimensión del Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_dimensions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Dimensión del Parqueadero</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->parking_dimension_id }} <br />
        <b>Nombre:</b> {{ $data['row']->parking_dimension_name }} <br /> 
        <b>Tamaño:</b> {{ $data['row']->parking_dimension_size }} <br /> 
        <b>Largo:</b> {{ $data['row']->parking_dimension_long }}<br /> 
        <b>Alto:</b> {{ $data['row']->parking_dimension_height }}<br /> 
        <b>Ancho:</b> {{ $data['row']->parking_dimension_width }}<br /> 
        <b>Icono:</b> <br /> 
        @if ($data['row']->parking_dimension_icon)
            <img src="{{ asset( 'storage/' . $data['row']->parking_dimension_icon) }}" class="img-responsive" >                                
        @endif
    </p>
@endsection