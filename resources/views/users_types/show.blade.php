@extends('layouts.dashboard')
@section('title', 'Ver Tipo de Usuario')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Tipo de Usuario</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users_types/index">Tipos de Usuarios</a></li>
            <li class="breadcrumb-item active">Ver Tipo de Usuario </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_types/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Tipo de Usuario</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->user_type_id }} <br />
        <b>Descripción:</b> {{ $data['row']->user_type_description }}
    </p>
@endsection