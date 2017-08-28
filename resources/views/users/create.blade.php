@extends('layouts.dashboard')
@section('title', 'Registrar Usuario')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Usuario</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Gestor de Usuarios</a></li>
            <li class="breadcrumb-item active">Registrar Usuario </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/users/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Usuario</h3>
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
                        <label class="control-label">Número ID</label>
                        <input id="user_number_id" name="user_number_id" class="form-control" placeholder="Número ID" type="text" value="{{ old('user_number_id') }}">
                        <small class="form-control-feedback"> Ingrese el Número ID</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Número de Empleado</label>
                        <input id="user_number_employee" name="user_number_employee" class="form-control" placeholder="Número de Empleado" type="text" value="{{ old('user_number_employee') }}">
                        <small class="form-control-feedback"> Ingrese el Número de Empleado</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Apellidos</label>
                        <input id="user_firstname" name="user_firstname" class="form-control" placeholder="Apellidos" type="text" value="{{ old('user_firstname') }}">
                        <small class="form-control-feedback"> Ingrese los Apellidos</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nombres</label>
                        <input id="user_lastname" name="user_lastname" class="form-control" placeholder="Nombres" type="text" value="{{ old('user_lastname') }}">
                        <small class="form-control-feedback"> Ingrese los Nombres</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <select class="custom-select col-4" name="user_type_description">
                            <option>Seleccione</option>
                            @foreach ($data['users_types'] as $r)
                            <option @if (old('user_type_description') == $r->user_type_description ) selected=""  @endif value="{{$r->user_type_description}}">{{$r->user_type_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Tipo</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">División</label>
                        <select class="custom-select col-4" name="user_division_description">
                            <option>Seleccione</option>
                            @foreach ($data['users_divisions'] as $r)
                            <option @if (old('user_division_description') == $r->user_division_description ) selected=""  @endif value="{{$r->user_division_description}}">{{$r->user_division_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione División</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Cargo</label>
                        <select class="custom-select col-4" name="user_position_description">
                            <option>Seleccione</option>
                            @foreach ($data['users_positions'] as $r)
                            <option @if (old('user_position_description') == $r->user_position_description ) selected=""  @endif value="{{$r->user_position_description}}">{{$r->user_position_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Cargo</small> 
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input id="email" name="email" class="form-control" placeholder="Nombres" type="text" value="{{ old('email') }}">
                        <small class="form-control-feedback"> Ingrese el E-mail</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Rol</label>
                        <select class="custom-select col-4" name="user_rol_name">
                            <option>Seleccione</option>
                            @foreach ($data['roles'] as $r)
                            <option @if (old('user_rol_name') == $r->rol_name ) selected=""  @endif value="{{$r->rol_name}}">{{$r->rol_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Rol</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Foto</label>
                        <input type="file" name="user_image" />
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection