@extends('layouts.dashboard')
@section('title', 'Cambiar Clave')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Cambiar Clave</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/profile">Mis Datos</a></li>
            <li class="breadcrumb-item active">Cambiar Clave </li>
        </ol>
    </div>
@endsection
@section('content')
	<form method="POST" action="/dashboard/profile/password/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Cambiar Clave</h3>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Clave</label>
                        <input id="clave" name="clave" class="form-control" placeholder="Clave" type="password">
                        <small class="form-control-feedback"> Ingrese la Clave</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Repetir Clave</label>
                        <input id="repetir_clave" name="repetir_clave" class="form-control" placeholder="Repetir Clave" type="password">
                        <small class="form-control-feedback"> Ingrese la Clave nuevamente</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/dashboard/profile" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_id" value="{{ $data['user']->user_id }}">
        </div>
    </form>
@endsection