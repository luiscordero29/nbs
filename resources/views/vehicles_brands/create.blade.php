@extends('layouts.dashboard')
@section('title', 'Registrar Marca de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/vehicles_brands/index') }}">Vehiculos Marcas</a></li>
            <li class="breadcrumb-item active">Registrar Marca de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/vehicles_brands/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ url('/vehicles_brands/store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Marca de Vehiculo</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_type_uid')) has-danger @endif">
                        <label class="form-control-label">Tipo</label>
                        <select class="custom-select select2 col-12" name="vehicle_type_uid">
                            <option value="">Seleccione</option>
                            @foreach ($data['vehicles_types'] as $r)
                            <option @if (old('vehicle_type_uid') == $r->vehicle_type_uid ) selected=""  @endif value="{{$r->vehicle_type_uid}}">{{$r->vehicle_type_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('vehicle_type_uid'))
                            @foreach ($errors->get('vehicle_type_uid') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Seleccione Tipo</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_brand_name')) has-danger @endif">
                        <label class="form-control-label">Marca</label>
                        <input id="vehicle_brand_name" name="vehicle_brand_name" class="form-control" placeholder="Marca" type="text" value="{{ old('vehicle_brand_name') }}">
                        @if ($errors->has('vehicle_brand_name'))
                            @foreach ($errors->get('vehicle_brand_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese la marcar</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_brand_description')) has-danger @endif">
                        <label class="form-control-label">Descripción</label>
                        <input id="vehicle_brand_description" name="vehicle_brand_description" class="form-control" placeholder="Descripción" type="text" value="{{ old('vehicle_brand_description') }}">
                        @if ($errors->has('vehicle_brand_description'))
                            @foreach ($errors->get('vehicle_brand_description') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese la descripción</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_brand_logo')) has-danger @endif">
                        <label class="form-control-label">Logo</label>
                        <input type="file" name="vehicle_brand_logo" />
                        @if ($errors->has('vehicle_brand_logo'))
                            @foreach ($errors->get('vehicle_brand_logo') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="{{ url('/vehicles_brands/index') }}" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection