@extends('layouts.dashboard')
@section('title', 'Registrar Tipo de Usuario')
@section('breadcrumb')
    <div class="col-md-6 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Tipo de Usuario</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Configuraciones</a></li>
            <li class="breadcrumb-item"><a href="/types/index">Tipos de Usuarios</a></li>
            <li class="breadcrumb-item active">Registrar Tipo de Usuario </li>
        </ol>
    </div>
    <div class="col-md-6 col-4 align-self-center">
        <a href="/types/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/types/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Tipo de Usuario</h3>
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
                        <label class="control-label">Descripción</label>
                        <input id="type_description" name="type_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('type_description') }}">
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/types/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection