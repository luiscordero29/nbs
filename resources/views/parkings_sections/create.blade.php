@extends('layouts.dashboard')
@section('title', 'Registrar Sección')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Sección</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings_sections/index">Secciones</a></li>
            <li class="breadcrumb-item active">Registrar Sección </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_sections/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/parkings_sections/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Sección</h3>
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Nombre de la sección</label>
                        <input id="parking_section_name" name="parking_section_name" class="form-control" placeholder="Sección" type="text" value="{{ old('parking_section_name') }}">
                        <small class="form-control-feedback"> Ingrese la sección</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/parkings_sections/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection