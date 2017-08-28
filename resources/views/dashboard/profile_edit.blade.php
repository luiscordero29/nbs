@extends('layouts.dashboard')
@section('title', 'Editar Mis Datos')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Mis Datos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/profile">Mis Datos</a></li>
            <li class="breadcrumb-item active">Editar Mis Datos </li>
        </ol>
    </div>
@endsection
@section('content')
	<form method="POST" action="/dashboard/profile/edit/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Mis Datos</h3>
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
                        <label class="control-label">Apellidos</label>
                        <input id="user_firstname" name="user_firstname" class="form-control" placeholder="Apellidos" type="text" value="{{ $data['user']->user_firstname }}">
                        <small class="form-control-feedback"> Ingrese los Apellidos</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nombres</label>
                        <input id="user_lastname" name="user_lastname" class="form-control" placeholder="Nombres" type="text" value="{{ $data['user']->user_lastname }}">
                        <small class="form-control-feedback"> Ingrese los Nombres</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input id="email" name="email" class="form-control" placeholder="Nombres" type="text" value="{{ $data['user']->email }}">
                        <small class="form-control-feedback"> Ingrese el E-mail</small> 
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