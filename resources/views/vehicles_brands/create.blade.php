@extends('layouts.dashboard')
@section('title', 'Registrar Marca de Vehiculo')
@section('breadcrumb')
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Marca de Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Configuraciones</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_brands/index">Vehiculos Marcas</a></li>
            <li class="breadcrumb-item active">Registrar Marca de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <a href="/vehicles_brands/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/vehicles_brands/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Marca de Vehiculo</h3>
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
                        <input id="vehicle_brand_name" name="vehicle_brand_name" class="form-control" placeholder="Marca" type="text" value="{{ old('vehicle_brand_name') }}" autofocus="">
                        <small class="form-control-feedback"> Ingrese la marcar</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <input id="vehicle_brand_description" name="vehicle_brand_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('vehicle_brand_description') }}">
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Logo</label>
                        <input type="file" name="vehicle_brand_logo" />
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_brands/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection