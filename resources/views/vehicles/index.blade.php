@extends('layouts.dashboard')
@section('title', 'Vehiculos')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item active">Vehiculos </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/vehicles/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h3 class="card-title">Lista de Vehiculos</h3>
        </div>
        <div class="col-3">
            <form method="POST" action="{{ url('/vehicles/index') }}">
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
                    <th>Empleado</th>
                    <th>Vehiculo</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
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
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <b>Tipo: </b>{{ $r->vehicle_type_name }}
                                </div>
                                <div class="col-12">
                                    <b>Pico y Placa: </b>
                                    @if($r->vehicle_status == 'does not apply')
                                        NO APLICA
                                    @elseif ($r->vehicle_status == 'even')
                                        PAR
                                    @else
                                        IMPAR
                                    @endif
                                </div>
                                <div class="col-12">
                                    <b>Placa: </b>{{ $r->vehicle_code }}
                                </div> 
                            </div>
                        </td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="{{ url('/vehicles/show/'.$r->vehicle_uid) }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse"></i> </a>
                                <a class="btn btn-secondary" href="{{ url('/vehicles/edit/'.$r->vehicle_uid) }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse"></i> </a>
                                <a class="btn btn-secondary" href="{{ url('/vehicles/destroy/'.$r->vehicle_uid) }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection