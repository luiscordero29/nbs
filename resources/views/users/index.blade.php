@extends('layouts.dashboard')
@section('title', 'Gestor de Usuarios')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Gestor de Usuarios</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item active">Gestor de Usuarios </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h6>Gestor de Usuarios</h6>
        	<p>Lista de Usuarios</p>
        </div>
        <div class="col-3">
            <form method="POST" action="/users/index">
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
                    <th>Datos</th>
                    <th>Foto</th>
                    <th class="text-nowrap">Acción</th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data as $r)
                    <tr>
                       	<td>{{ $r->user_id }}</td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <b>Número ID: </b>{{ $r->user_number_id }}
                                </div>
                                <div class="col-6">
                                    <b>Número de Empleado: </b>{{ $r->user_number_employee }}
                                </div>
                                <div class="col-6">
                                    <b>Apellidos: </b>{{ $r->user_firstname }}
                                </div>
                                <div class="col-6">
                                    <b>Nombres: </b>{{ $r->user_lastname }}
                                </div>
                                <div class="col-4">
                                    <b>Tipo: </b>{{ $r->user_type_description }}
                                </div> 
                                <div class="col-4">
                                    <b>División: </b>{{ $r->user_division_description }}
                                </div> 
                                <div class="col-4">
                                    <b>Cargo: </b>{{ $r->user_position_description }}
                                </div>   
                                <div class="col-8">
                                    <b>E-mail: </b>{{ $r->email }}<br />
                                </div>
                                <div class="col-4">
                                    <b>Rol: </b>{{ $r->rol_description }}<br />
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($r->user_image)
                                <img src="{{ asset( 'storage/' . $r->user_image) }}" width="100px" height="auto">                                
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="/users_vehicles/index/{{ $r->user_id }}" data-toggle="tooltip" data-original-title="Vehiculos"> <i class="fa fa-car text-inverse m-r-10"></i> </a>
                            <a href="/users/show/{{ $r->user_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                            <a href="/users/edit/{{ $r->user_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a href="/users/destroy/{{ $r->user_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data->links() }}
@endsection