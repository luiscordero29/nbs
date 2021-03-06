@extends('layouts.dashboard')
@section('title', 'Registrar Color')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicles_colors/index') }}">Colores de Vehiculos</a></li>
            <li class="breadcrumb-item active">Registrar Color </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/vehicles_colors/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ url('/vehicles_colors/store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Color</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_color_name')) has-danger @endif">
                        <label class="form-control-label">Color</label>
                        <input id="vehicle_color_name" name="vehicle_color_name" class="form-control" placeholder="Color" type="text" value="{{ old('vehicle_color_name') }}">
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
            <a href="{{ url('/vehicles_colors/index') }}" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection