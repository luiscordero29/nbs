@extends('layouts.dashboard')
@section('title', 'Registrar Parqueadero')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Parqueadero</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings/index">Parqueaderos</a></li>
            <li class="breadcrumb-item active">Registrar Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/parkings/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Parqueadero</h3>
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
            <div class="row p-t-20">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Tipo de Vehiculo</label>
                        <select class="custom-select select2 col-12" name="vehicle_type_name">
                            @foreach ($data['vehicles_types'] as $r)
                            <option @if (old('vehicle_type_name') == $r->vehicle_type_name ) selected=""  @endif value="{{$r->vehicle_type_name}}">{{$r->vehicle_type_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Tipo</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Dimensión del Parqueadero</label>
                        <select class="custom-select select2 col-12" name="parking_dimension_name">
                            @foreach ($data['parkings_dimensions'] as $r)
                            <option @if (old('parking_dimension_name') == $r->parking_dimension_name ) selected=""  @endif value="{{$r->parking_dimension_name}}">{{$r->parking_dimension_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Dimensión</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Sección</label>
                        <select class="custom-select select2 col-12" name="parking_section_name">
                            @foreach ($data['parkings_sections'] as $r)
                            <option @if (old('parking_section_name') == $r->parking_section_name ) selected=""  @endif value="{{$r->parking_section_name}}">{{$r->parking_section_name}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Sección</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Nombre del la Parqueadero</label>
                        <input id="parking_name" name="parking_name" class="form-control" placeholder="Nombre del la Parqueadero" type="text" value="{{ old('parking_name') }}">
                        <small class="form-control-feedback"> Ingrese el nombre del Parqueadero</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Descripción del Parqueadero</label>
                        <input id="parking_description" name="parking_description" class="form-control" placeholder="Descripción del Parqueadero" type="text" value="{{ old('parking_description') }}">
                        <small class="form-control-feedback"> Ingrese la descripción del Parqueadero</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Foto</label>
                        <input type="file" name="parking_photo" />
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/parkings/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection