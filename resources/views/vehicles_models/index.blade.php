@extends('layouts.dashboard')
@section('title', 'Vehiculos Modelos')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Vehiculos Modelos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Configuraciones</a></li>
            <li class="breadcrumb-item active">Vehiculos Modelos </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_models/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h6>Vehiculos Modelos</h6>
        	<p>Lista de Vehiculos Modelos</p>
        </div>
        <div class="col-3">
            <form method="POST" action="/vehicles_models/index">
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
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th class="text-nowrap">Acción</th>
                </tr>
            </thead>
            <tbody>
    			@foreach ($data as $r)
                    <tr>
                       	<td>{{ $r->vehicle_model_id }}</td>
                        <td>{{ $r->vehicle_brand_name }}</td>
                        <td>{{ $r->vehicle_model_name }} <br />{{ $r->vehicle_model_description }}</td>
                        <td class="text-nowrap">
                            <a href="/vehicles_models/show/{{ $r->vehicle_model_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                            <a href="/vehicles_models/edit/{{ $r->vehicle_model_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a href="/vehicles_models/destroy/{{ $r->vehicle_model_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                        </td>
                    </tr>             
				@endforeach
             	</tbody>
        </table>
    </div>
    {{ $data->links() }}
@endsection