@extends('layouts.dashboard')
@section('title', 'Editar Sección')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Sección</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings_sections/index">Divisiones</a></li>
            <li class="breadcrumb-item active">Editar Sección </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/parkings_sections/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/parkings_sections/update/{{ $data['row']->parking_section_id }}">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Sección</h3>
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
                        <label class="control-label">Sección</label>
                        <input id="parking_section_name" name="parking_section_name" class="form-control" placeholder="Sección" type="text" value="{{ $data['row']->parking_section_name }}">
                        <small class="form-control-feedback"> Editar Sección</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/parkings_sections/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="parking_section_id" value="{{ $data['row']->parking_section_id }}">
        </div>
    </form>
@endsection