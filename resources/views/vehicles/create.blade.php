@extends('layouts.dashboard')
@section('title', 'Registrar Vehiculo')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Vehiculo</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/vehicles/index">Vehiculos</a></li>
            <li class="breadcrumb-item active">Registrar Vehiculo </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/vehicles/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/vehicles/store" enctype="multipart/form-data">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Empleado</label>
                                    <select class="custom-select select2 col-12" name="vehicles_user_number_id" id="user_number_id">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['users'] as $r)
                                        <option @if (old('user_number_id') == $r->user_number_id ) selected=""  @endif value="{{$r->user_number_id}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_type_name" id="vehicles_vehicle_type_name">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['vehicles_types'] as $r)
                                        <option @if (old('vehicle_type_name') == $r->vehicle_type_name ) selected=""  @endif value="{{$r->vehicle_type_name}}">{{$r->vehicle_type_name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Marca</label>
                                    <select class="custom-select select2 col-12" name="vehicle_brand_name" id="vehicles_vehicle_brand_name">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Marca</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Modelo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_model_name" id="vehicles_create_vehicle_model_name">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Modelo</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Apodo</label>
                                    <input id="vehicle_name" name="vehicle_name" class="form-control" placeholder="Apodo" type="text" value="{{ old('vehicle_name') }}">
                                    <small class="form-control-feedback"> Ingrese el Apodo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Color</label>
                                    <select class="custom-select select2 col-12" name="vehicle_color_name" id="vehicle_color_name">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['vehicles_colors'] as $r)
                                        <option @if (old('vehicle_color_name') == $r->vehicle_color_name ) selected=""  @endif value="{{$r->vehicle_color_name}}">{{$r->vehicle_color_name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pico y Placa</label>
                                    <select class="custom-select select2 col-12" name="vehicle_status" id="vehicle_status">
                                        <option value="" selected>Seleccione</option>
                                        <option @if (old('vehicle_status') == 'does not apply' ) selected=""  @endif value="does not apply">NO APLICA</option>
                                        <option @if (old('vehicle_status') == 'even' ) selected=""  @endif value="even">PAR</option>
                                        <option @if (old('vehicle_status') == 'odd' ) selected=""  @endif value="odd">IMPAR</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Placa</label>
                                    <input id="vehicle_code" name="vehicle_code" class="form-control" placeholder="Placa" type="text" value="{{ old('vehicle_code') }}">
                                    <small class="form-control-feedback"> Ingrese la placa</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Año</label>
                                    <input id="vehicle_year" name="vehicle_year" class="form-control" placeholder="Año" type="text" value="{{ old('vehicle_year') }}">
                                    <small class="form-control-feedback"> Ingrese la Año</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Foto</label>
                                    <input type="file" name="vehicle_image" />
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Empleado</label>
                                    <select class="custom-select select2 col-12" name="vehicles_user_number_id" id="user_number_id">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['users'] as $r)
                                        <option @if (old('user_number_id') == $r->user_number_id ) selected=""  @endif value="{{$r->user_number_id}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Tipo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_type_name" id="vehicles_vehicle_type_name">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['vehicles_types'] as $r)
                                        <option @if (old('vehicle_type_name') == $r->vehicle_type_name ) selected=""  @endif value="{{$r->vehicle_type_name}}">{{$r->vehicle_type_name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Marca</label>
                                    <select class="custom-select select2 col-12" name="vehicle_brand_name" id="vehicles_vehicle_brand_name">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Marca</small> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Modelo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_model_name" id="vehicles_create_vehicle_model_name">
                                        <option value="" selected>Seleccione</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Modelo</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Apodo</label>
                                    <input id="vehicle_name" name="vehicle_name" class="form-control" placeholder="Apodo" type="text" value="{{ old('vehicle_name') }}">
                                    <small class="form-control-feedback"> Ingrese el Apodo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Color</label>
                                    <select class="custom-select select2 col-12" name="vehicle_color_name" id="vehicle_color_name">
                                        <option value="" selected>Seleccione</option>
                                        @foreach ($data['vehicles_colors'] as $r)
                                        <option @if (old('vehicle_color_name') == $r->vehicle_color_name ) selected=""  @endif value="{{$r->vehicle_color_name}}">{{$r->vehicle_color_name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pico y Placa</label>
                                    <select class="custom-select select2 col-12" name="vehicle_status" id="vehicle_status">
                                        <option value="" selected>Seleccione</option>
                                        <option @if (old('vehicle_status') == 'does not apply' ) selected=""  @endif value="does not apply">NO APLICA</option>
                                        <option @if (old('vehicle_status') == 'even' ) selected=""  @endif value="even">PAR</option>
                                        <option @if (old('vehicle_status') == 'odd' ) selected=""  @endif value="odd">IMPAR</option>
                                    </select>
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Placa</label>
                                    <input id="vehicle_code" name="vehicle_code" class="form-control" placeholder="Placa" type="text" value="{{ old('vehicle_code') }}">
                                    <small class="form-control-feedback"> Ingrese la placa</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Año</label>
                                    <input id="vehicle_year" name="vehicle_year" class="form-control" placeholder="Año" type="text" value="{{ old('vehicle_year') }}">
                                    <small class="form-control-feedback"> Ingrese la Año</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Foto</label>
                                    <input type="file" name="vehicle_image" />
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                </div>
            </div>                                        
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/vehicles/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
        $('#vehicles_vehicle_type_name').change(function(even) {
            var vehicle_type_name = $(this).val();
            $.getJSON( "/vehicles/getbrands/" + vehicle_type_name, function( data ) {
                $.each( data, function( key, val ) {
                    $("#vehicles_vehicle_brand_name").append('<option value="' + val['vehicle_brand_name'] + '">' + val['vehicle_brand_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_brand_name'] );
                });
            });
        });
        $('#vehicles_vehicle_brand_name').change(function(even) {
            var vehicle_brand_name = $(this).val();
            $.getJSON( "/vehicles/getmodels/" + vehicle_brand_name, function( data ) {
                $.each( data, function( key, val ) {
                    $("#vehicles_create_vehicle_model_name").append('<option value="' + val['vehicle_model_name'] + '">' + val['vehicle_model_name'] + '</option>')
                    console.log( key + " - " + val['vehicle_model_name'] );
                });
            });
        });
    </script>
@endsection