@extends('layouts.dashboard')
@section('title', 'Editar Dimensión del Parqueadero')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/parkings_dimensions/index') }}">Dimensiones</a></li>
            <li class="breadcrumb-item active">Editar Dimensión del Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/parkings_dimensions/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="{{ url('/parkings_dimensions/update/'.$data['row']->parking_dimension_uid) }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Dimensión del Parqueadero</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('parking_dimension_name')) has-danger @endif">
                        <label class="form-control-label">Nombre</label>
                        <input id="parking_dimension_name" name="parking_dimension_name" class="form-control" placeholder="Nombre" type="text" value="{{ $data['row']->parking_dimension_name }}">
                        @if ($errors->has('parking_dimension_name'))
                            @foreach ($errors->get('parking_dimension_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese el Nombre</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group @if($errors->has('parking_dimension_size')) has-danger @endif">
                        <label class="form-control-label">Tamaño</label>
                        <input id="parking_dimension_size" name="parking_dimension_size" class="form-control" placeholder="Tamaño" type="text" value="{{ $data['row']->parking_dimension_size }}">
                        @if ($errors->has('parking_dimension_size'))
                            @foreach ($errors->get('parking_dimension_size') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese el tamaño</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group @if($errors->has('parking_dimension_long')) has-danger @endif">
                        <label class="form-control-label">Largo</label>
                        <input id="parking_dimension_long" name="parking_dimension_long" class="form-control" placeholder="Largo" type="text" value="{{ $data['row']->parking_dimension_long }}">
                        @if ($errors->has('parking_dimension_long'))
                            @foreach ($errors->get('parking_dimension_long') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese largo</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group @if($errors->has('parking_dimension_height')) has-danger @endif">
                        <label class="form-control-label">Alto</label>
                        <input id="parking_dimension_height" name="parking_dimension_height" class="form-control" placeholder="Descripción" type="text" value="{{ $data['row']->parking_dimension_height }}">
                        @if ($errors->has('parking_dimension_height'))
                            @foreach ($errors->get('parking_dimension_height') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese alto</small> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group @if($errors->has('parking_dimension_width')) has-danger @endif">
                        <label class="form-control-label">Ancho</label>
                        <input id="parking_dimension_width" name="parking_dimension_width" class="form-control" placeholder="Descripción" type="text" value="{{ $data['row']->parking_dimension_width }}">
                        @if ($errors->has('parking_dimension_width'))
                            @foreach ($errors->get('parking_dimension_width') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese ancho</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('parking_dimension_icon')) has-danger @endif">
                        <label class="form-control-label">Icono</label>
                        <input type="file" name="parking_dimension_icon" />
                        @if ($errors->has('parking_dimension_icon'))
                            @foreach ($errors->get('parking_dimension_icon') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    @if ($data['row']->parking_dimension_icon)
                        <img src="{{ asset( 'storage/' . $data['row']->parking_dimension_icon) }}" class="img-responsive">                                
                    @endif
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="{{ url('/parkings_dimensions/index') }}" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="parking_dimension_uid" value="{{ $data['row']->parking_dimension_uid }}">
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection