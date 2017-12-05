@extends('layouts.dashboard')
@section('title', 'Registrar Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/user_vehicles/index') }}">Vehiculos</a></li>
            <li class="breadcrumb-item active">Registrar Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="{{ url('/user_vehicles/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ url('/user_vehicles/store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Vehiculo</h3>
            <hr>
            @include('dashboard.alerts')
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#required_fields" role="tab" aria-expanded="true"><span><i class="fa fa-asterisk"></i> Requerido</span></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#extra_fields" role="tab" aria-expanded="false"><span><i class="fa fa-plus"></i> Otros</span></a></li>
            </ul>
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="required_fields" role="tabpanel" aria-expanded="true">
                    <div class="p-20">   
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('vehicle_type_uid')) has-danger @endif">
                                    <label class="form-control-label" for="users_vehicles_vehicle_type_uid">Tipo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_type_uid" id="vehicles_vehicle_type_uid">
                                        <option value="">Selecionar</option>
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
                                <div class="form-group @if($errors->has('vehicle_status')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_status">Pico y Placa</label>
                                    <select class="custom-select select2 col-12" name="vehicle_status" id="vehicle_status">
                                        <option value="">Selecionar</option>
                                        <option @if (old('vehicle_status') == 'does not apply' ) selected=""  @endif value="does not apply">NO APLICA</option>
                                        <option @if (old('vehicle_status') == 'even' ) selected=""  @endif value="even">PAR</option>
                                        <option @if (old('vehicle_status') == 'odd' ) selected=""  @endif value="odd">IMPAR</option>
                                    </select>
                                    @if ($errors->has('vehicle_status'))
                                        @foreach ($errors->get('vehicle_status') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('vehicle_code')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_code">Placa</label>
                                    <input id="vehicle_code" name="vehicle_code" class="form-control" placeholder="Placa" type="text" value="{{ old('vehicle_code') }}">
                                    @if ($errors->has('vehicle_code'))
                                        @foreach ($errors->get('vehicle_code') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese la placa</small> 
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->                                        
                    </div>
                </div>
                <div class="tab-pane" id="extra_fields" role="tabpanel" aria-expanded="false">
                    <div class="p-20">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_brand_uid')) has-danger @endif">
                                    <label class="form-control-label" for="vehicles_vehicle_brand_uid">Marca</label>
                                    <select class="custom-select select2 col-12" name="vehicle_brand_uid" id="vehicles_vehicle_brand_uid" style="width: 100%">
                                        <option value="">Selecionar</option>
                                    </select>
                                    @if ($errors->has('vehicle_brand_uid'))
                                        @foreach ($errors->get('vehicle_brand_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Marca</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_model_uid')) has-danger @endif">
                                    <label class="form-control-label" for="vehicles_create_vehicle_model_uid">Modelo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_model_uid" id="vehicles_create_vehicle_model_uid" style="width: 100%">
                                        <option value="">Selecionar</option>
                                    </select>
                                    @if ($errors->has('vehicle_model_uid'))
                                        @foreach ($errors->get('vehicle_model_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Modelo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_color_uid')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_color_uid">Color</label>
                                    <select class="custom-select select2 col-12" name="vehicle_color_uid" id="vehicle_color_uid" style="width: 100%">
                                        <option value="">Selecionar</option>
                                        @foreach ($data['vehicles_colors'] as $r)
                                        <option @if (old('vehicle_color_uid') == $r->vehicle_color_uid ) selected=""  @endif value="{{$r->vehicle_color_uid}}">{{$r->vehicle_color_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_color_uid'))
                                        @foreach ($errors->get('vehicle_color_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group @if($errors->has('vehicle_name')) has-danger @endif">
                                    <label class="form-control-label">Apodo</label>
                                    <input id="vehicle_name" name="vehicle_name" class="form-control" placeholder="Apodo" type="text" value="{{ old('vehicle_name') }}">
                                    @if ($errors->has('vehicle_name'))
                                        @foreach ($errors->get('vehicle_name') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el Apodo</small> 
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_year')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_year">Año</label>
                                    <input data-mask="9999" id="vehicle_year" name="vehicle_year" class="form-control" placeholder="Año" type="text" value="{{ old('vehicle_year') }}">
                                    @if ($errors->has('vehicle_year'))
                                        @foreach ($errors->get('vehicle_year') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese la Año</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('vehicle_image')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_image">Foto</label>
                                    <input id="vehicle_image" type="file" name="vehicle_image" />
                                    @if ($errors->has('vehicle_image'))
                                        @foreach ($errors->get('vehicle_image') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row--> 
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="{{ url('/user_vehicles/index') }}" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_uid" value="{{ $data['user']->user_uid }}">
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
        $('#vehicles_vehicle_type_uid').change(function(even) {
            var vehicle_type_uid = $(this).val();
            $("#vehicles_vehicle_brand_uid").html('<option value="">Seleccione</option>');
            $.getJSON( "{{ url('user_vehicles/getbrands') }}" + '/' + vehicle_type_uid, function( data ) {
                $.each( data, function( key, val ) {
                    $("#vehicles_vehicle_brand_uid").append('<option value="' + val['vehicle_brand_uid'] + '">' + val['vehicle_brand_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_brand_name'] );
                });
            });
        });
        $('#vehicles_vehicle_brand_uid').change(function(even) {
            var vehicle_brand_uid = $(this).val();
            $("#vehicles_create_vehicle_model_uid").html('<option value="">Seleccione</option>');
            $.getJSON( "{{ url('user_vehicles/getmodels') }}" + '/' + vehicle_brand_uid, function( data ) {
                $.each( data, function( key, val ) {
                    $("#vehicles_create_vehicle_model_uid").append('<option value="' + val['vehicle_model_uid'] + '">' + val['vehicle_model_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_model_name'] );
                });
            });
        });
    </script>
@endsection