@extends('layouts.dashboard')
@section('title', 'Dimensiones')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Dimensiones</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Dimensiones </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_dimensions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h6>Dimensiones</h6>
        	<p>Lista de dimenciones de parkeaderos</p>
        </div>
        <div class="col-3">
            <form method="POST" action="/parkings_dimensions/index">
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
                    <th>Nombre</th>
                    <th>Tamaño</th>
                    <th>Largo</th>
                    <th>Alto</th>
                    <th>Ancho</th>
                    <th>Icono</th>
                    <th class="text-nowrap">Acción</th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                       	<td>{{ $r->parking_dimension_id }}</td>
                        <td>{{ $r->parking_dimension_name }}</td>
                        <td>{{ $r->parking_dimension_size }}</td>
                        <td>{{ $r->parking_dimension_long }}</td>
                        <td>{{ $r->parking_dimension_height }}</td>
                        <td>{{ $r->parking_dimension_width }}</td>
                        <td>
                            @if ($r->parking_dimension_icon)
                                <img src="{{ asset( 'storage/' . $r->parking_dimension_icon) }}" width="150px" height="auto">                                
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <a href="/parkings_dimensions/show/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                            <a href="/parkings_dimensions/edit/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a href="/parkings_dimensions/destroy/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection