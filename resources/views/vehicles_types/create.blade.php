@extends('layouts.dashboard')
@section('title', 'Registrar Tipo de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_types/index">Vehiculos Tipos</a></li>
            <li class="breadcrumb-item active">Registrar Tipo de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_types/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/vehicles_types/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Tipo de Vehiculo</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_type_name')) has-danger @endif">
                        <label class="form-control-label">Tipo</label>
                        <input id="vehicle_type_name" name="vehicle_type_name" class="form-control" placeholder="Tipo" type="text" value="{{ old('vehicle_type_name') }}">
                        @if ($errors->has('vehicle_type_name'))
                            @foreach ($errors->get('vehicle_type_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese el tipo de vehiculo</small> 
                    </div>
                </div>
                <div class="col-md-12 @if($errors->has('vehicle_type_description')) has-danger @endif">
                    <div class="form-group">
                        <label class="form-control-label">Descripción</label>
                        <input id="vehicle_type_description" name="vehicle_type_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('vehicle_type_description') }}">
                        @if ($errors->has('vehicle_type_description'))
                            @foreach ($errors->get('vehicle_type_description') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese la descripción del tipo de vehiculo</small> 
                    </div>
                </div>
                <div class="col-md-12 @if($errors->has('vehicle_type_icon')) has-danger @endif">
                    <div class="form-group">
                        <label class="form-control-label">Icono</label>
                        <input type="file" name="vehicle_type_icon" />
                        @if ($errors->has('vehicle_type_icon'))
                            @foreach ($errors->get('vehicle_type_icon') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_types/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection