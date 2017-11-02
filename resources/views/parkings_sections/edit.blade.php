@extends('layouts.dashboard')
@section('title', 'Editar Sección')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
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
	<form method="POST" action="/parkings_sections/update/{{ $data['row']->parking_section_uid }}">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Sección</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('parking_section_name')) has-danger @endif">
                        <label class="form-control-label">Sección</label>
                        <input id="parking_section_name" name="parking_section_name" class="form-control" placeholder="Sección" type="text" value="{{ $data['row']->parking_section_name }}">
                        @if ($errors->has('parking_section_name'))
                            @foreach ($errors->get('parking_section_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
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
            <input type="hidden" name="parking_section_uid" value="{{ $data['row']->parking_section_uid }}">
        </div>
    </form>
@endsection