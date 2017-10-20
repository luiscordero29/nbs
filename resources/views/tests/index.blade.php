@extends('layouts.dashboard')
@section('title', 'Evaluaciones')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Evaluaciones </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/tests/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
        </div>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h3 class="card-title">Lista de Evaluaciones</h3>
        </div>
        <div class="col-3">
            <form method="POST" action="/tests/index">
                {{ csrf_field() }}
                <div class="form-group">
                    <input id="search" name="search" class="form-control" placeholder="Buscar" type="text" 
                        @if (session('search'))
                            value="{{ session('search') }}" 
                        @endif
                    >
                </div>
            </form>
        </div>
    </div>
    @include('dashboard.alerts')
	<div class="table-responsive">
       	<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Evaluación</th>
                    <th>Empleado</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                        <td>
                            @php
                                $date_array = explode('-',$r->test_date);
                                $date_array = array_reverse($date_array);   
                                $date    = date(implode('/', $date_array));
                                echo $date;
                            @endphp
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    {{ $r->reward_name }} Crédito: {{ $r->reward_ammount }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <b>Número ID: </b>{{ $r->user_number_id }}
                                </div>
                                <div class="col-12">
                                    <b>Número de Empleado: </b>{{ $r->user_number_employee }}
                                </div>
                                <div class="col-12">
                                    <b>Apellidos: </b>{{ $r->user_firstname }}
                                </div>
                                <div class="col-12">
                                    <b>Nombres: </b>{{ $r->user_lastname }}
                                </div>
                            </div>
                        </td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="/tests/show/{{ $r->test_uid }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye"></i> </a>
                                <a class="btn btn-secondary" href="/tests/edit/{{ $r->test_uid }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil"></i> </a>
                                <a class="btn btn-secondary" href="/tests/destroy/{{ $r->test_uid }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection