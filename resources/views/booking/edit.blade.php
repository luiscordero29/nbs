@extends('layouts.dashboard')
@section('title', 'Editar Usuario')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Usuario</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Gestor de Usuarios</a></li>
            <li class="breadcrumb-item active">Editar Usuario </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/users/update/{{ $data['row']->user_id }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Usuario</h3>
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
                        <input id="user_number_id" name="user_number_id" class="form-control" placeholder="Número ID" type="text" value="{{ $data['row']->user_number_id }}">
                        <small class="form-control-feedback"> Ingrese el Número ID</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Número de Empleado</label>
                        <input id="user_number_employee" name="user_number_employee" class="form-control" placeholder="Número de Empleado" type="text" value="{{ $data['row']->user_number_employee }}">
                        <small class="form-control-feedback"> Ingrese el Número de Empleado</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Apellidos</label>
                        <input id="user_firstname" name="user_firstname" class="form-control" placeholder="Apellidos" type="text" value="{{ $data['row']->user_firstname }}">
                        <small class="form-control-feedback"> Ingrese los Apellidos</small> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nombres</label>
                        <input id="user_lastname" name="user_lastname" class="form-control" placeholder="Nombres" type="text" value="{{ $data['row']->user_lastname }}">
                        <small class="form-control-feedback"> Ingrese los Nombres</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Tipo</label>
                        <select class="custom-select select2 col-4" name="user_type_description">
                            @foreach ($data['users_types'] as $r)
                            <option @if ($data['row']->user_type_description == $r->user_type_description ) selected=""  @endif value="{{$r->user_type_description}}">{{$r->user_type_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Tipo</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">División</label>
                        <select class="custom-select select2 col-4" name="user_division_description">
                            @foreach ($data['users_divisions'] as $r)
                            <option @if ($data['row']->user_division_description == $r->user_division_description ) selected=""  @endif value="{{$r->user_division_description}}">{{$r->user_division_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione División</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Cargo</label>
                        <select class="custom-select select2 col-4" name="user_position_description">
                            @foreach ($data['users_positions'] as $r)
                            <option @if ($data['row']->user_position_description == $r->user_position_description ) selected=""  @endif value="{{$r->user_position_description}}">{{$r->user_position_description}}</option>
                            @endforeach
                        </select>
                        <small class="form-control-feedback"> Seleccione Cargo</small> 
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input id="email" name="email" class="form-control" placeholder="Nombres" type="text" value="{{ $data['row']->email }}">
                        <small class="form-control-feedback"> Ingrese el E-mail</small> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Rol</label>
                        <select class="custom-select select2 col-4" name="user_rol_name">
                            @foreach ($data['roles'] as $r)
                            <option @if ($data['row']->user_rol_name == $r->rol_name ) selected=""  @endif value="{{$r->rol_name}}">{{$r->rol_description}}</option>
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
                <div class="col-md-3">
                    <div class="form-group">
                        @if ($data['row']->user_image)
                            <img src="{{ asset( 'storage/' . $data['row']->user_image) }}" class="img-responsive">                                
                        @endif
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_id" value="{{ $data['row']->user_id }}">
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection