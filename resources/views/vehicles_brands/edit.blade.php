@extends('layouts.dashboard')
@section('title', 'Editar Marca de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Marca de Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Configuraciones</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_brands/index">Vehiculos Marcas</a></li>
            <li class="breadcrumb-item active">Editar Marca de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_brands/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/vehicles_brands/update/{{ $data->vehicle_brand_id }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Marca de Vehiculo</h3>
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
                        <label class="control-label">Marca</label>
                        <input id="vehicle_brand_name" name="vehicle_brand_name" class="form-control" placeholder="Marca" type="text" value="{{ $data->vehicle_brand_name }}" autofocus="">
                        <small class="form-control-feedback"> Ingrese la marcar</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <input id="vehicle_brand_description" name="vehicle_brand_description" class="form-control" placeholder="Descripción" type="text" value="{{ $data->vehicle_brand_description }}">
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Logo</label>
                        <input type="file" name="vehicle_brand_logo" />
                        <br >
                        @if ($data->vehicle_brand_logo)
                            <img src="{{ asset( 'storage/' . $data->vehicle_brand_logo) }}" width="150px" height="auto">                                
                        @endif
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_brands/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="vehicle_brand_id" value="{{ $data->vehicle_brand_id }}">
        </div>
    </form>
@endsection