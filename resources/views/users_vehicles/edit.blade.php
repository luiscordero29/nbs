@extends('layouts.dashboard')
@section('title', 'Editar Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Usuarios</a></li>
            <li class="breadcrumb-item"><a href="/users_vehicles/index/{{ $data['row']->user_id }}">Vehiculos</a></li>
            <li class="breadcrumb-item active">Editar Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users_vehicles/create/{{ $data['row']->user_id }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
	<form method="POST" action="/users_vehicles/update/{{ $data['row']->user_id }}/{{ $data['row']->vehicle_id }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Vehiculo</h3>
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
                                <div class="form-group @if($errors->has('vehicle_type_name')) has-danger @endif">
                                    <label class="form-control-label" for="users_vehicles_vehicle_type_name">Tipo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_type_name" id="users_vehicles_vehicle_type_name">
                                        <option value="">Selecionar</option>
                                        @foreach ($data['vehicles_types'] as $r)
                                        <option @if ($data['row']->vehicle_type_name == $r->vehicle_type_name ) selected=""  @endif value="{{$r->vehicle_type_name}}">{{$r->vehicle_type_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_type_name'))
                                        @foreach ($errors->get('vehicle_type_name') as $error)
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
                                        <option @if ($data['row']->vehicle_status == 'does not apply' ) selected=""  @endif value="does not apply">NO APLICA</option>
                                        <option @if ($data['row']->vehicle_status == 'even' ) selected=""  @endif value="even">PAR</option>
                                        <option @if ($data['row']->vehicle_status == 'odd' ) selected=""  @endif value="odd">IMPAR</option>
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
                                    <input id="vehicle_code" name="vehicle_code" class="form-control" placeholder="Placa" type="text" value="{{ $data['row']->vehicle_code }}">
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
                                <div class="form-group @if($errors->has('vehicle_brand_name')) has-danger @endif">
                                    <label class="form-control-label" for="users_vehicles_vehicle_brand_name">Marca</label>
                                    <select class="custom-select select2 col-12" name="vehicle_brand_name" id="users_vehicles_vehicle_brand_name" style="width: 100%">
                                        <option value="">Selecionar</option>
                                        @foreach ($data['vehicles_brands'] as $r)
                                        <option @if ($data['row']->vehicle_brand_name == $r->vehicle_brand_name ) selected=""  @endif value="{{$r->vehicle_brand_name}}">{{$r->vehicle_brand_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_brand_name'))
                                        @foreach ($errors->get('vehicle_brand_name') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Marca</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_model_name')) has-danger @endif">
                                    <label class="form-control-label" for="vehicles_create_vehicle_model_name">Modelo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_model_name" id="vehicles_create_vehicle_model_name" style="width: 100%">
                                        <option value="">Selecionar</option>
                                        @foreach ($data['vehicles_models'] as $r)
                                        <option @if ($data['row']->vehicle_model_name == $r->vehicle_model_name ) selected=""  @endif value="{{$r->vehicle_model_name}}">{{$r->vehicle_model_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_model_name'))
                                        @foreach ($errors->get('vehicle_model_name') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Modelo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group @if($errors->has('vehicle_color_name')) has-danger @endif">
                                    <label class="form-control-label" for="vehicle_color_name">Color</label>
                                    <select class="custom-select select2 col-12" name="vehicle_color_name" id="vehicle_color_name" style="width: 100%">
                                        <option value="">Selecionar</option>
                                        @foreach ($data['vehicles_colors'] as $r)
                                        <option @if ($data['row']->vehicle_color_name == $r->vehicle_color_name ) selected=""  @endif value="{{$r->vehicle_color_name}}">{{$r->vehicle_color_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_color_name'))
                                        @foreach ($errors->get('vehicle_color_name') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group @if($errors->has('vehicle_name')) has-danger @endif">
                                    <label class="form-control-label">Apodo</label>
                                    <input id="vehicle_name" name="vehicle_name" class="form-control" placeholder="Apodo" type="text" value="{{ $data['row']->vehicle_name }}">
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
                                    <input data-mask="9999" id="vehicle_year" name="vehicle_year" class="form-control" placeholder="Año" type="text" value="{{ $data['row']->vehicle_year }}">
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
                            @if ($data['row']->vehicle_image)
                            <div class="col-md-3">
                                <img src="{{ asset( 'storage/' . $data['row']->vehicle_image) }}" class="img-responsive" >                                
                            </div>
                            @endif
                            <!--/span-->
                        </div>
                        <!--/row--> 
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users_vehicles/index/{{ $data['row']->user_id }}" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="user_number_id" value="{{ $data['row']->user_number_id }}">
            <input type="hidden" name="vehicle_id" value="{{ $data['row']->vehicle_id }}">
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
        $('#users_vehicles_vehicle_type_name').change(function(even) {
            var vehicle_type_name = $(this).val();
            $("#users_vehicles_vehicle_brand_name").html('<option value="">Selecionar</option>');
            $("#vehicles_create_vehicle_model_name").html('<option value="">Selecionar</option>');
            $.getJSON( "/users_vehicles/getbrands/" + vehicle_type_name, function( data ) {
                $.each( data, function( key, val ) {
                    $("#users_vehicles_vehicle_brand_name").append('<option value="' + val['vehicle_brand_name'] + '">' + val['vehicle_brand_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_brand_name'] );
                });
            });
        });
        $('#users_vehicles_vehicle_brand_name').change(function(even) {
            var vehicle_brand_name = $(this).val();
            $("#vehicles_create_vehicle_model_name").html('<option value="">Selecionar</option>');
            $.getJSON( "/users_vehicles/getmodels/" + vehicle_brand_name, function( data ) {
                $.each( data, function( key, val ) {
                    $("#vehicles_create_vehicle_model_name").append('<option value="' + val['vehicle_model_name'] + '">' + val['vehicle_model_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_model_name'] );
                });
            });
        });
    </script>
@endsection