@extends('layouts.dashboard')
@section('title', 'Ver Rol')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Rol</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/roles/index">Roles</a></li>
            <li class="breadcrumb-item active">Ver Rol </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/roles/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Rol</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data->rol_id }} <br />
        <b>Nombre:</b> {{ $data->rol_name }} <br />
        <b>Descripción:</b> {{ $data->rol_description }}
    </p>
@endsection