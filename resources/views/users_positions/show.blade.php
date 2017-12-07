@extends('layouts.dashboard')
@section('title', 'Ver Cargo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-users"></i> Usuarios</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users_positions/index') }}">Cargos</a></li>
            <li class="breadcrumb-item active">Ver Cargo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/users_positions/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Cargo</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->user_position_id }} <br />
        <b>Descripción:</b> {{ $data['row']->user_position_description }}
    </p>
@endsection