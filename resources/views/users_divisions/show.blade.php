@extends('layouts.dashboard')
@section('title', 'Ver División')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Ver División</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users_divisions/index">Divisións</a></li>
            <li class="breadcrumb-item active">Ver División </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_divisions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver División</h4>
    <p class="card-text">
        <b>ID:</b> {{ $data['row']->user_division_id }} <br />
        <b>Descripción:</b> {{ $data['row']->user_division_description }}
    </p>
@endsection