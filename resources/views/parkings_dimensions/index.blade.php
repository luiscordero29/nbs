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
            <h3 class="card-title">Lista de dimenciones de los parkeaderos</h3>
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
    @include('dashboard.alerts')
	<div class="table-responsive">
       	<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                       	<td>{{ $r->parking_dimension_id }}</td>
                        <td>{{ $r->parking_dimension_name }}</td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="/parkings_dimensions/show/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye"></i> </a>
                                <a class="btn btn-secondary" href="/parkings_dimensions/edit/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil"></i> </a>
                                <a class="btn btn-secondary" href="/parkings_dimensions/destroy/{{ $r->parking_dimension_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection