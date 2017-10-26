@extends('layouts.dashboard')
@section('title', 'Registrar Cargo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-users"></i> Usuarios</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users_positions/index">Cargos</a></li>
            <li class="breadcrumb-item active">Registrar Cargo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_positions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/users_positions/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Cargo</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('user_position_description')) has-danger @endif">
                        <label class="form-control-label">Descripción</label>
                        <input id="user_position_description" name="user_position_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('user_position_description') }}">
                        @if ($errors->has('user_position_description'))
                            @foreach ($errors->get('user_position_description') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users_positions/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection