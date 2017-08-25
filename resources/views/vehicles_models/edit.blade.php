@extends('layouts.dashboard')
@section('title', 'Editar Modelo de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Modelo de Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_models/index">Vehiculos Modelos</a></li>
            <li class="breadcrumb-item active">Editar Modelo de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_models/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/vehicles_models/update/{{ $data['row']->vehicle_model_id }}">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Modelo de Vehiculo</h3>
            <hr>
            @if ($errors->any())
			    @foreach ($errors->all() as $error)
			    <div class="alert alert-danger">
			        {{ $error }}
			    </div>
			    @endforeach
			@endif
			@if (session('success'))
			    <div class="alert alert-success">
			        {{ session('success') }}
			    </div>
			@endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Tipo/Marca</label>
                        <select class="custom-select col-12" name="vehicle_brand_name">
                            <option>Seleccione</option>
                            @foreach ($data['vehicles_brands'] as $r)
                            <option @if ($data['row']->vehicle_brand_name == $r->vehicle_brand_name ) selected=""  @endif value="{{$r->vehicle_brand_name}}">{{$r->vehicle_type_name}} -> {{$r->vehicle_brand_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Marca</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Nombre del Modelo</label>
                        <input id="vehicle_model_name" name="vehicle_model_name" class="form-control" placeholder="Nombre del Modelo" type="text" value="{{ $data['row']->vehicle_model_name }}">
                        <small class="form-control-feedback"> Ingrese el nombre del nombre</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Descripción del Modelo</label>
                        <input id="vehicle_model_description" name="vehicle_model_description" class="form-control" placeholder="Descripción del Modelo" type="text" value="{{ $data['row']->vehicle_model_description }}">
                        <small class="form-control-feedback"> Ingrese la descripción del modelo</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_models/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="vehicle_model_id" value="{{ $data['row']->vehicle_model_id }}">
        </div>
    </form>
@endsection