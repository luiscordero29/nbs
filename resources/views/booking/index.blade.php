@extends('layouts.booking')
@section('title', 'Reservas')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Reservas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Reservas </li>
        </ol>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form id="form-booking-search" method="POST" action="/booking/index">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search" class="control-label">Buscar: </label>
                                <input id="search" name="search" class="form-control" placeholder="Buscar" type="text" value="{{ $data['search'] }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="parking_section_name-text-input" class="control-label">Sección: </label>
                                <select id="parking_section_name" class="custom-select col-md-12" name="parking_section_name">
                                    <option value="">Seleccione</option>
                                    @foreach ($data['parkings_sections'] as $r)
                                    <option @if ($data['parking_section_name'] == $r->parking_section_name ) selected=""  @endif value="{{$r->parking_section_name}}">{{$r->parking_section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="datepicker-autoclose" class="control-label">Fecha: </label>
                                <div class="input-group">
                                    <input name="today" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" type="text" readonly="" 
                                    value="@php 
                                        $date_array = explode('-',$data['today']);
                                        $date_array = array_reverse($date_array);   
                                        $date    = date(implode('/', $date_array));
                                        echo $date;
                                    @endphp">
                                    <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group submit">
                                <button type="submit" class="btn btn-success btn-block waves-effect waves-light">Consultar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
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
                @php
                    
                    $week = new DateTime($data['today']);
                    $week = $week->format('l');
                    switch ($week) {
                        case 'Monday':
                            $week = 'Lunes';
                            break;
                        case 'Tuesday':
                            $week = 'Martes';
                            break;
                        case 'Wednesday':
                            $week = 'Miercoles';
                            break;
                        case 'Thursday':
                            $week = 'Jueves';
                            break;
                        case 'Friday':
                            $week = 'Viernes';
                            break;
                        case 'Saturday':
                            $week = 'Sabado';
                            break;
                        case 'Sunday':
                            $week = 'Domingo';
                            break;
                    }
                    echo $week.' '.$date;

                @endphp

                <hr>
                    
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Parqueadero</th>
                            <th>Empleado</th>
                            <th>Vehiculo</th>
                            <th class="text-nowrap">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $r)
                            <tr>
                                <td>
                                    <b>ID:</b> {{ $r->parking_id }} <br />
                                    <b>Sección:</b> {{ $r->parking_section_name }} <br />
                                    <b>Tipo:</b> {{ $r->vehicle_type_name }} <br />
                                    <b>Nombre: </b>{{ $r->parking_name }} <br />
                                    <b>Descripción: </b>{{ $r->parking_description }}   
                                </td>
                                <td>
                                    @foreach ($data['booking'] as $b)
                                        @if($r->parking_name == $b->parking_name)
                                            <b>Número ID: </b>{{ $b->user_number_id }} <br />
                                            <b>Número de Empleado: </b>{{ $b->user_number_employee }} <br />
                                            <b>Apellidos: </b>{{ $b->user_firstname }} <br />
                                            <b>Nombres: </b>{{ $b->user_lastname }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data['booking'] as $b)
                                        @if($r->parking_name == $b->parking_name)
                                            <b>Apodo: </b>{{ $b->vehicle_name }}<br />
                                            <b>Pico y Placa: </b>
                                            @if($b->vehicle_status == 'does not apply')
                                                NO APLICA
                                            @elseif ($b->vehicle_status == 'even')
                                                PAR
                                            @else
                                                IMPAR
                                            @endif<br />
                                            <b>Placa: </b>{{ $b->vehicle_code }}<br />
                                            <b>Año: </b>{{ $b->vehicle_year }}<br />
                                            <b>Color: </b>{{ $b->vehicle_color_name }}
                                        @endif
                                    @endforeach
                                </td>                                   
                                <td class="text-nowrap">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        @if(count($data['booking'])>0)
                                            @foreach ($data['booking'] as $b)
                                                @if($r->parking_name == $b->parking_name)
                                                    <button type="button" class="btn btn-sm btn-info btn-booking-update" data-parking_name="{{ $r->parking_name }}"><i class="fa fa-car"></i> Cambiar Asignación</button>
                                                    <button type="button" class="btn btn-sm btn-danger btn-booking-delete" data-parking_name="{{ $r->parking_name }}" data-booking_id="{{ $b->booking_id }}"><i class="fa fa-car"></i> Remover Asignación</button>
                                                @else
                                                    <button class="btn btn-sm btn-success btn-booking-create" data-parking_name="{{ $r->parking_name }}"><i class="fa fa-car"></i> Asignar Parqueadero</button>
                                                @endif
                                            @endforeach
                                        @else
                                            <button class="btn btn-sm btn-success btn-booking-create" data-parking_name="{{ $r->parking_name }}"><i class="fa fa-car"></i> Asignar Parqueadero</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>             
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- booking-create -->
<div id="modal-booking-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-booking-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Asignar Reservar</h4>
            </div>
            <div class="modal-body">
                <form id="booking_create" method="POST" action="/booking/store">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Empleado</label>
                            <select class="custom-select select2" name="booking_user_number_id" id="booking_user_number_id" style="width: 100%" required="">
                                <option value="">Seleccione</option>
                                @foreach ($data['users'] as $r)
                                <option @if (old('user_number_id') == $r->user_number_id ) selected=""  @endif value="{{$r->user_number_id}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                @endforeach
                            </select>
                            <small class="form-control-feedback"> Seleccione Empleado</small> 
                        </div>
                        <div class="form-group">
                            <label class="control-label">Vehiculo</label>
                            <select class="custom-select select2" name="booking_vehicle_code" id="booking_vehicle_code" style="width: 100%" required="">
                                <option value="">Seleccione</option>
                            </select>
                            <small class="form-control-feedback"> Seleccione Vehiculo</small> 
                        </div>
                    </div>
                    <input type="hidden" id="booking_date" name="booking_date" value="{{ $data['today'] }}">
                    <input id="parking_name" type="hidden" name="parking_name" value="">
                    <input id="search" type="hidden" name="search" value="{{ $data['search'] }}">
                    <input id="parking_section_name" type="hidden" name="parking_section_name" value="{{ $data['parking_section_name'] }}">
                    <input id="today" type="hidden" name="today" value="{{ $data['today'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button id="booking_submit" type="button" class="btn btn-danger waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- booking-delete -->
<form id="booking_delete" method="POST" action="/booking/destroy">
    {{ csrf_field() }}
    <input type="hidden" id="delete_booking_id" name="booking_id" value="">
    <input type="hidden" id="booking_date" name="booking_date" value="{{ $data['today'] }}">
    <input id="search" type="hidden" name="search" value="{{ $data['search'] }}">
    <input id="parking_section_name" type="hidden" name="parking_section_name" value="{{ $data['parking_section_name'] }}">
    <input id="today" type="hidden" name="today" value="{{ $data['today'] }}">
</form>
@endsection
@section('script')
<script type="text/javascript">
    $(".select2").select2();
    $("#booking_user_number_id").change(function(even) {
        var user_number_id = $(this).val();
        var booking_date = $("#booking_date").val();
        $('#booking_user_number_id_hidden').val(user_number_id);
        $.getJSON( "/booking/getvehicles/" + user_number_id + '/' + booking_date , function( data ) {
            $("#booking_vehicle_code").html('<option value="">Seleccione</option>')
            $.each( data, function( key, val ) {
                $("#booking_vehicle_code").append('<option value="' + val['vehicle_code'] + '">' + val['vehicle_code'] + ' ' + val['vehicle_name'] + '</option>')
                console.log( key + " - " + val['vehicle_code'] + ' ' + val['vehicle_name'] );
            });
        });
    });
    $("#booking_vehicle_code").change(function(even) {
        var vehicle_code = $(this).val();
        $('#booking_vehicle_code_hidden').val(vehicle_code);
    });
    $("#booking_submit").on( "click", function ( e ) {
        $("#booking_create").submit();
    });
    $( ".btn-booking-create" ).on( "click", function( e ) {
        var parking_name  = $(this).data('parking_name');
        $( "#parking_name" ).val( parking_name );
        console.log( parking_name );
        $('#modal-booking-create').modal('show');
    });
    $( ".btn-booking-delete" ).on( "click", function( e ) {
        var booking_id  = $(this).data('booking_id');
        $( "#delete_booking_id" ).val( booking_id );
        $("#booking_delete").submit();
    });
    $('#datepicker-autoclose').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection
