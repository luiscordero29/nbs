@extends('layouts.dashboard')
@section('title', 'Parqueaderos')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Parqueaderos </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/parkings_lot/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Varios</a>
            <a href="/parkings/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Uno</a>
        </div>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h3 class="card-title">Lista de Parkeaderos</h3>
        </div>
        <div class="col-3">
            <form method="POST" action="/parkings/index">
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
                    <th>Sección</th>
                    <th>Tipo</th>
                    <th>Parqueadero</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                       	<td>{{ $r->parking_id }}</td>
                        <td>{{ $r->parking_section_name }}</td>
                        <td>{{ $r->vehicle_type_name }}</td>
                        <td>{{ $r->parking_name }}</td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="/parkings/show/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye"></i> </a>
                                <a class="btn btn-secondary" href="/parkings/edit/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil"></i> </a>
                                <a class="btn btn-secondary" href="/parkings/destroy/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection