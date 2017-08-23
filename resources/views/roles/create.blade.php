@extends('layouts.dashboard')
@section('title', 'Registrar Rol')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Rol</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/roles/index">Roles</a></li>
            <li class="breadcrumb-item active">Registrar Rol </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/roles/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/roles/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Rol</h3>
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
                        <label class="control-label">Nombre</label>
                        <input id="rol_name" name="rol_name" class="form-control" placeholder="Nombre" type="text" value="{{ old('rol_name') }}" autofocus="">
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Descripción</label>
                        <input id="rol_description" name="rol_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('rol_description') }}">
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/roles/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection