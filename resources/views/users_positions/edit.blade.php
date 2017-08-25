@extends('layouts.dashboard')
@section('title', 'Editar Cargo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Cargo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users_positions/index">Cargos</a></li>
            <li class="breadcrumb-item active">Editar Cargo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_positions/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/users_positions/update/{{ $data->user_position_id }}">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Cargo</h3>
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
                        <label class="control-label">Descripción</label>
                        <input id="user_position_description" name="user_position_description" class="form-control" placeholder="Descripción" type="text" value="{{ $data->user_position_description }}">
                        <small class="form-control-feedback"> Editar descripción</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users_positions/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_position_id" value="{{ $data->user_position_id }}">
        </div>
    </form>
@endsection