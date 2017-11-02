@extends('layouts.dashboard')
@section('title', 'Ver Parqueadero')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings/index">Parqueaderos</a></li>
            <li class="breadcrumb-item active">Ver Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/parkings_lot/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Varios</a>
            <a href="/parkings/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Uno</a>
        </div>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Parqueadero</h4>
    <div class="row">
        @if ($data['row']->parking_photo)
        <div class="col-10">
            <div class="row">
                <div class="col-4">
                    <b>ID:</b> {{ $data['row']->parking_id }}
                </div>
                <div class="col-4">
                    <b>Sección:</b> {{ $data['row']->parking_section->parking_section_name }}
                </div>
                <div class="col-4">
                    <b>Tipo:</b> {{ $data['row']->vehicle_type->vehicle_type_name }}
                </div>
                <div class="col-12">
                    <b>Nombre: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_name)
                        {{ $data['row']->parking_dimension->parking_dimension_name }}
                    @endisset
                </div>
                <div class="col-3">
                    <b>Tamaño: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_size)
                        {{ $data['row']->parking_dimension->parking_dimension_size }}
                    @endisset
                </div> 
                <div class="col-3">
                    <b>Largo: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_long)
                        {{ $data['row']->parking_dimension->parking_dimension_long }}
                    @endisset
                </div> 
                <div class="col-3">
                    <b>Alto: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_height)
                        {{ $data['row']->parking_dimension->parking_dimension_height }}
                    @endisset
                </div>   
                <div class="col-3">
                    <b>Ancho: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_width)
                        {{ $data['row']->parking_dimension->parking_dimension_width }}
                    @endisset
                </div>
            </div>
        </div>
        <div class="col-2">
            <img src="{{ asset( 'storage/' . $data['row']->parking_photo) }}" class="img-responsive" >                                
        </div>
        @else
        <div class="col-12">
            <div class="row">
                <div class="col-4">
                    <b>ID:</b> {{ $data['row']->parking_id }}
                </div>
                <div class="col-4">
                    <b>Sección:</b> {{ $data['row']->parking_section->parking_section_name }}
                </div>
                <div class="col-4">
                    <b>Tipo:</b> {{ $data['row']->vehicle_type->vehicle_type_name }}
                </div>
                <div class="col-12">
                    <b>Nombre: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_name)
                        {{ $data['row']->parking_dimension->parking_dimension_name }}
                    @endisset
                </div>
                <div class="col-3">
                    <b>Tamaño: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_size)
                        {{ $data['row']->parking_dimension->parking_dimension_size }}
                    @endisset
                </div> 
                <div class="col-3">
                    <b>Largo: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_long)
                        {{ $data['row']->parking_dimension->parking_dimension_long }}
                    @endisset
                </div> 
                <div class="col-3">
                    <b>Alto: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_height)
                        {{ $data['row']->parking_dimension->parking_dimension_height }}
                    @endisset
                </div>   
                <div class="col-3">
                    <b>Ancho: </b>
                    @isset($data['row']->parking_dimension->parking_dimension_width)
                        {{ $data['row']->parking_dimension->parking_dimension_width }}
                    @endisset
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection