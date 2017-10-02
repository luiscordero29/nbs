@extends('layouts.dashboard')
@section('title', 'Editar Color')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Color</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_colors/index">Colores de Vehiculos</a></li>
            <li class="breadcrumb-item active">Editar Color </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_colors/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/vehicles_colors/update/{{ $data['row']->vehicle_color_id }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Color</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_color_name')) has-danger @endif">
                        <label class="form-control-label">Color</label>
                        <input id="vehicle_color_name" name="vehicle_color_name" class="form-control" placeholder="Tipo" type="text" value="{{ $data['row']->vehicle_color_name }}">
                        @if ($errors->has('vehicle_color_name'))
                            @foreach ($errors->get('vehicle_color_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese el Color</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_colors/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="vehicle_color_id" value="{{ $data['row']->vehicle_color_id }}">
        </div>
    </form>
@endsection