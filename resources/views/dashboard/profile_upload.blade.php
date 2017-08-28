@extends('layouts.dashboard')
@section('title', 'Subir Foto')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Subir Foto</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/profile">Mis Datos</a></li>
            <li class="breadcrumb-item active">Subir Foto </li>
        </ol>
    </div>
@endsection
@section('content')
	<form method="POST" action="/dashboard/profile/upload/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Subir Foto</h3>
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
                        <label class="control-label">Foto</label>
                        <input type="file" name="user_image" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        @if ($data['user']->user_image)
                            <img src="{{ asset( 'storage/' . $data['user']->user_image) }}" class="img-responsive">                                
                        @endif
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
            <input type="hidden" name="user_number_id" value="{{ $data['user']->user_number_id }}">
        </div>
    </form>
@endsection