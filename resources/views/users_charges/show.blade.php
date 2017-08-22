@extends('layouts.dashboard')
@section('title', 'Ver Cargo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver Cargo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users_charges/index">Cargos</a></li>
            <li class="breadcrumb-item active">Ver Cargo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_charges/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Cargo</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data->user_charge_id }} <br />
        <b>Descripción:</b> {{ $data->user_charge_description }}
    </p>
@endsection