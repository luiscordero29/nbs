@extends('layouts.dashboard')
@section('title', 'Editar División')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-users"></i> Usuarios</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users_divisions/index') }}">Divisiones</a></li>
            <li class="breadcrumb-item active">Editar División </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/users_divisions/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="{{ url('/users_divisions/update/'.$data['row']->user_division_uid) }}">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar División</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('user_division_description')) has-danger @endif">
                        <label class="control-label">Descripción</label>
                        <input id="user_division_description" name="user_division_description" class="form-control" placeholder="Descripción" type="text" value="{{ $data['row']->user_division_description }}">
                        @if ($errors->has('user_division_description'))
                            @foreach ($errors->get('user_division_description') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Editar descripción</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="{{ url('/users_divisions/index') }}" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_division_uid" value="{{ $data['row']->user_division_uid }}">
        </div>
    </form>
@endsection