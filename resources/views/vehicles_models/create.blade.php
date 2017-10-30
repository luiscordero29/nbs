@extends('layouts.dashboard')
@section('title', 'Registrar Modelo de Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-car"></i> Vehiculos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles_models/index">Vehiculos Modelos</a></li>
            <li class="breadcrumb-item active">Registrar Modelo de Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles_models/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/vehicles_models/store">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Modelo de Vehiculo</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="form-group @if($errors->has('vehicle_type_uid')) has-danger @endif">
                        <label class="form-control-label">Tipo</label>
                        <select class="custom-select select2 col-12" name="vehicle_type_uid" id="vehicles_models_vehicle_type_uid">
                            <option value="" selected>Seleccione</option>
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
                <div class="col-md-6">
                    <div class="form-group @if($errors->has('vehicle_brand_uid')) has-danger @endif">
                        <label class="form-control-label">Marca</label>
                        <select class="custom-select select2 col-12" name="vehicle_brand_uid" id="vehicles_models_vehicle_brand_uid">                           
                            <option value="" selected>Seleccione</option>
                        </select>
                        @if ($errors->has('vehicle_brand_uid'))
                            @foreach ($errors->get('vehicle_brand_uid') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Seleccione Marca</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_model_name')) has-danger @endif">
                        <label class="form-control-label">Nombre del Modelo</label>
                        <input id="vehicle_model_name" name="vehicle_model_name" class="form-control" placeholder="Nombre del Modelo" type="text" value="{{ old('vehicle_model_name') }}">
                        @if ($errors->has('vehicle_model_name'))
                            @foreach ($errors->get('vehicle_model_name') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese el nombre del nombre</small> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group @if($errors->has('vehicle_model_description')) has-danger @endif">
                        <label class="form-control-label">Descripción del Modelo</label>
                        <input id="vehicle_model_description" name="vehicle_model_description" class="form-control" placeholder="Descripción del Modelo" type="text" value="{{ old('vehicle_model_description') }}">
                        @if ($errors->has('vehicle_model_description'))
                            @foreach ($errors->get('vehicle_model_description') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                        <small class="form-control-feedback"> Ingrese la descripción del modelo</small> 
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles_models/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
        $('#vehicles_models_vehicle_type_uid').change(function(even) {
            var vehicle_type_uid = $(this).val();
            $.getJSON( "/vehicles_models/getbrands/" + vehicle_type_uid, function( data ) {
                $("#vehicles_models_vehicle_brand_uid").html('');
                $("#vehicles_models_vehicle_brand_uid").append('<option value="">Seleccione</option>');
                $.each( data, function( key, val ) {
                    $("#vehicles_models_vehicle_brand_uid").append('<option value="' + val['vehicle_brand_uid'] + '">' + val['vehicle_brand_name'] + '</option>');
                    console.log( key + " - " + val['vehicle_brand_uid'] );
                });
            });
        })
    </script>
@endsection