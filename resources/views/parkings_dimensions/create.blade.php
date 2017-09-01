@extends('layouts.dashboard')
@section('title', 'Registrar Dimension del Parqueadero')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Dimension del Parqueadero</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings_dimensions/index">Parqueaderos</a></li>
            <li class="breadcrumb-item active">Registrar Dimension del Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_dimensions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/parkings_dimensions/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Dimension del Parqueadero</h3>
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
                        <label class="control-label">Nombre</label>
                        <input id="parking_dimension_name" name="parking_dimension_name" class="form-control" placeholder="Nombre" type="text" value="{{ old('parking_dimension_name') }}">
                        <small class="form-control-feedback"> Ingrese el Nombre</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Tamaño</label>
                        <input id="parking_dimension_size" name="parking_dimension_size" class="form-control" placeholder="Tamaño" type="text" value="{{ old('parking_dimension_size') }}">
                        <small class="form-control-feedback"> Ingrese el tamaño</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Largo</label>
                        <input id="parking_dimension_long" name="parking_dimension_long" class="form-control" placeholder="Largo" type="text" value="{{ old('parking_dimension_long') }}">
                        <small class="form-control-feedback"> Ingrese largo</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Alto</label>
                        <input id="parking_dimension_height" name="parking_dimension_height" class="form-control" placeholder="Descripción" type="text" value="{{ old('parking_dimension_height') }}">
                        <small class="form-control-feedback"> Ingrese alto</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Ancho</label>
                        <input id="parking_dimension_width" name="parking_dimension_width" class="form-control" placeholder="Descripción" type="text" value="{{ old('parking_dimension_width') }}">
                        <small class="form-control-feedback"> Ingrese ancho</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Icono</label>
                        <input type="file" name="parking_dimension_icon" />
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/parkings_dimensions/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection