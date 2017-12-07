@extends('layouts.dashboard')
@section('title', 'Ver Recompensa')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/rewards/index') }}">Recompensas</a></li>
            <li class="breadcrumb-item active">Ver Recompensa </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="{{ url('/rewards/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
        </div>
    </div>
@endsection
@section('content')
    <h4 class="card-title">Ver Recompensa</h4>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-2">
                    <b>ID:</b> {{ $data['row']->reward_id }}
                </div>
                <div class="col-5">
                    <b>Nombre:</b> {{ $data['row']->reward_name }}
                </div>
                <div class="col-2">
                    <b>Crédito:</b> {{ $data['row']->reward_ammount }}
                </div>
                <div class="col-3">
                    <b>Estatus:</b> 
                        @if($data['row']->reward_status)
                            Habilidato
                        @else
                            Desabilitado
                        @endif
                </div>
                <div class="col-12">
                    <b>Descripción:</b> {{ $data['row']->reward_description }}
                </div>
            </div>
        </div>
    </div>
@endsection