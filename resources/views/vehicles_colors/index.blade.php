@extends('layouts.dashboard')
@section('title', 'Colores de Vehiculos')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Colores de Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Colores de Vehiculos </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_colors/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h3 class="card-title">Lista de Vehiculos Colores</h3>
        </div>
        <div class="col-3">
            <form method="POST" action="/vehicles_colors/index">
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
                    <th>Color</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data['rows'] as $r)
                    <tr>
                        <td>{{ $r->vehicle_color_id }}</td>
                       	<td>{{ $r->vehicle_color_name }}</td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="/vehicles_colors/show/{{ $r->vehicle_color_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse"></i> </a>
                                <a class="btn btn-secondary" href="/vehicles_colors/edit/{{ $r->vehicle_color_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse"></i> </a>
                                <a class="btn btn-secondary" href="/vehicles_colors/destroy/{{ $r->vehicle_color_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection