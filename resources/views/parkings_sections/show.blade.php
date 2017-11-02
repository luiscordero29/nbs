@extends('layouts.dashboard')
@section('title', 'Ver Sección')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings_sections/index">Seccións</a></li>
            <li class="breadcrumb-item active">Ver Sección </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_sections/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Sección</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->parking_section_id }} <br />
        <b>Sección:</b> {{ $data['row']->parking_section_name }}
    </p>
@endsection