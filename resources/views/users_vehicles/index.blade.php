@extends('layouts.dashboard')
@section('title', 'Vehiculos')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Gestor de Usuarios</a></li>
            <li class="breadcrumb-item active">Vehiculos </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_vehicles/create/{{ $data['row']->user_id }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-12">
            <h6>Vehiculos</h6>
        	<p>Lista de Vehiculos</p>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif
	<div class="table-responsive">
       	<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Empleado</th>
                    <th>Vehiculo</th>
                    <th>Foto</th>
                    <th class="text-nowrap">Acción</th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                        <td>{{ $r->vehicle_id }}</td>
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
                                <div class="col-12">
                                    <b>Tipo: </b>{{ $r->user_type_description }}
                                </div> 
                                <div class="col-12">
                                    <b>División: </b>{{ $r->user_division_description }}
                                </div> 
                                <div class="col-12">
                                    <b>Cargo: </b>{{ $r->user_position_description }}
                                </div>   
                                <div class="col-12">
                                    <b>E-mail: </b>{{ $r->email }}<br />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-12">
                                    <b>Tipo: </b>{{ $r->vehicle_type_name }}
                                </div>
                                <div class="col-12">
                                    <b>Marca: </b>{{ $r->vehicle_brand_name }}
                                </div>
                                <div class="col-12">
                                    <b>Modelo: </b>{{ $r->vehicle_model_name }}
                                </div>
                                <div class="col-12">
                                    <b>Apodo: </b>{{ $r->vehicle_name }}
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
                                <div class="col-12">
                                    <b>Año: </b>{{ $r->vehicle_year }}
                                </div> 
                                <div class="col-12">
                                    <b>Color: </b>{{ $r->vehicle_color_name }}
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($r->vehicle_image)
                                <img src="{{ asset( 'storage/' . $r->vehicle_image) }}" width="150px" height="auto">                                
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="/users_vehicles/show/{{ $data['row']->user_id }}/{{ $r->vehicle_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                            <a href="/users_vehicles/edit/{{ $data['row']->user_id }}/{{ $r->vehicle_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a href="/users_vehicles/destroy/{{ $data['row']->user_id }}/{{ $r->vehicle_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection