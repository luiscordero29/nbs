@extends('layouts.booking')
@section('title', 'Reservas')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Reservas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/users/index') }}">Usuarios</a></li>
            <li class="breadcrumb-item active">Reservas </li>
        </ol>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <div class="row">
                    <div class="col-6">
                        <b>Número ID: </b>{{ $data['users_booking']->user_number_id }}
                    </div>
                    <div class="col-6">
                        <b>Número de Empleado: </b>{{ $data['users_booking']->user_number_employee }}
                    </div>
                    <div class="col-12">
                        <b>Apellidos y Nombres: </b>
                        {{ $data['users_booking']->user_firstname }} {{ $data['users_booking']->user_lastname }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form id="form-booking-search" method="POST" action="{{ url('/users_booking/index/'.$data['users_booking']->user_uid) }}">
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
                                <label for="parking_section_uid" class="control-label">Sección: </label>
                                <select id="parking_section_uid" class="custom-select col-md-12" name="parking_section_uid">
                                    <option value="">Seleccione</option>
                                    @foreach ($data['parkings_sections'] as $r)
                                    <option @if ($data['parking_section_uid'] == $r->parking_section_uid ) selected=""  @endif value="{{$r->parking_section_uid}}">{{$r->parking_section_name}}</option>
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
                @include('dashboard.alerts')
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
                            <th class="text-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $r)
                            <tr>
                                <td>
                                    <b>Sección:</b> {{ $r->parking_section_name }} <br />
                                    <b>Tipo:</b> {{ $r->vehicle_type_name }} <br />
                                    <b>Nombre: </b>{{ $r->parking_name }} <br />
                                </td>
                                <td>
                                    @foreach ($data['booking'] as $b)
                                        @if($r->parking_uid == $b->parking_uid)
                                            <b>Número ID: </b>{{ $b->user_number_id }} <br />
                                            <b>Número de Empleado: </b>{{ $b->user_number_employee }} <br />
                                            <b>Apellidos: </b>{{ $b->user_firstname }} <br />
                                            <b>Nombres: </b>{{ $b->user_lastname }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($data['booking'] as $b)
                                        @if($r->parking_uid == $b->parking_uid)
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
                                        @endif
                                    @endforeach
                                </td>                                   
                                <td class="text-nowrap">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        @if($data['to_booking'])
                                            @php $create = false; @endphp
                                            @if(count($data['booking'])>0)
                                                @foreach ($data['booking'] as $b)
                                                    @if($r->parking_uid == $b->parking_uid)
                                                        @php $create = true; @endphp
                                                        <button type="button" class="btn btn-sm btn-info btn-booking-update" data-parking_uid="{{ $r->parking_uid }}" data-booking_uid="{{ $b->booking_uid }}"><i class="fa fa-car"></i> Cambiar Asignación</button>
                                                        <button type="button" class="btn btn-sm btn-danger btn-booking-delete" data-parking_uid="{{ $r->parking_uid }}" data-booking_uid="{{ $b->booking_uid }}"><i class="fa fa-car"></i> Remover Asignación</button>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if(!$create)
                                                <button class="btn btn-sm btn-success btn-booking-create" data-parking_uid="{{ $r->parking_uid }}"><i class="fa fa-car"></i> Asignar Parqueadero</button>
                                            @endif
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
                <form id="booking_create" method="POST" action="{{ url('/users_booking/store/'.$data['users_booking']->user_uid) }}">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Vehiculo</label>
                            <select class="custom-select select2" name="booking_vehicle_uid" id="booking_vehicle_uid" style="width: 100%" required="">
                                <option value="">Seleccione</option>
                            </select>
                            <small class="form-control-feedback"> Seleccione Vehiculo</small> 
                        </div>
                    </div>
                    <input type="hidden" id="booking_user_uid" name="booking_user_uid" value="{{ $data['users_booking']->user_uid }}">
                    <input type="hidden" id="booking_date" name="booking_date" value="{{ $data['today'] }}">
                    <input id="parking_uid" type="hidden" name="parking_uid" value="">
                    <input id="search" type="hidden" name="search" value="{{ $data['search'] }}">
                    <input id="parking_section_uid" type="hidden" name="parking_section_uid" value="{{ $data['parking_section_uid'] }}">
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
<!-- booking-update -->
<div id="modal-booking-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-booking-update" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Cambiar Asignación</h4>
            </div>
            <div class="modal-body">
                <form id="booking_update" method="POST" action="{{ url('/users_booking/update/'.$data['users_booking']->user_uid) }}">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Vehiculo</label>
                            <select class="custom-select select2" name="booking_vehicle_uid" id="booking_vehicle_uid_update" style="width: 100%" required="">
                                <option value="">Seleccione</option>
                            </select>
                            <small class="form-control-feedback"> Seleccione Vehiculo</small> 
                        </div>
                    </div>
                    <input type="hidden" id="booking_user_uid_update" name="booking_user_uid_update" value="{{ $data['users_booking']->user_uid }}">
                    <input type="hidden" id="booking_date_update" name="booking_date" value="{{ $data['today'] }}">
                    <input id="update_booking_uid" type="hidden" name="update_booking_uid" value="">
                    <input id="search" type="hidden" name="search" value="{{ $data['search'] }}">
                    <input id="parking_section_uid" type="hidden" name="parking_section_uid" value="{{ $data['parking_section_uid'] }}">
                    <input id="today" type="hidden" name="today" value="{{ $data['today'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                <button id="booking_update_submit" type="button" class="btn btn-danger waves-effect waves-light">Cambiar</button>
            </div>
        </div>
    </div>
</div>
<!-- booking-delete -->
<form id="booking_delete" method="POST" action="{{ url('/users_booking/destroy/'.$data['users_booking']->user_uid) }}">
    {{ csrf_field() }}
    <input type="hidden" id="delete_booking_uid" name="booking_uid" value="">
    <input type="hidden" id="booking_date" name="booking_date" value="{{ $data['today'] }}">
    <input id="search" type="hidden" name="search" value="{{ $data['search'] }}">
    <input id="parking_section_uid" type="hidden" name="parking_section_uid" value="{{ $data['parking_section_uid'] }}">
    <input id="today" type="hidden" name="today" value="{{ $data['today'] }}">
</form>
@endsection
@section('script')
<script type="text/javascript">
    $(".select2").select2();
    $("#booking_vehicle_uid").change(function(even) {
        var vehicle_uid = $(this).val();
        $('#booking_vehicle_uid_hidden').val(vehicle_uid);
    });
    $("#booking_submit").on( "click", function ( e ) {
        $("#booking_create").submit();
    });
    $("#booking_update_submit").on( "click", function ( e ) {
        $("#booking_update").submit();
    });
    $( ".btn-booking-create" ).on( "click", function( e ) {
        var user_uid = $("#booking_user_uid").val();
        var booking_date = $("#booking_date").val();
        // $('#booking_user_uid_hidden').val(user_uid);
        $.getJSON( "{{ url('/users_booking/getvehicles/') }}" + '/' + user_uid + '/' + booking_date , function( data ) {
            $("#booking_vehicle_uid").html('<option value="">Seleccione</option>')
            $.each( data, function( key, val ) {
                $("#booking_vehicle_uid").append('<option value="' + val['vehicle_uid'] + '">' + val['vehicle_code'] + '</option>')
                console.log( key + " - " + val['vehicle_uid'] + ' ' + val['vehicle_code'] + ' ' + val['vehicle_name'] );
            });
        });
        var parking_uid  = $(this).data('parking_uid');
        $( "#parking_uid" ).val( parking_uid );
        console.log( parking_uid );
        $('#modal-booking-create').modal('show');
    });
    $( ".btn-booking-update" ).on( "click", function( e ) {
        var user_uid = $("#booking_user_uid_update").val();
        var booking_date = $("#booking_date_update").val();
        console.log( 'user_uid: ' + user_uid );
        console.log( 'booking_date: ' + booking_date );

        // $('#booking_user_uid_hidden').val(user_uid);
        $.getJSON( "{{ url('/users_booking/getvehicles/') }}" + '/' + user_uid + '/' + booking_date , function( data ) {
            $("#booking_vehicle_uid_update").html('<option value="">Seleccione</option>')
            $.each( data, function( key, val ) {
                $("#booking_vehicle_uid_update").append('<option value="' + val['vehicle_uid'] + '">' + val['vehicle_code'] + '</option>')
                console.log( key + " - " + val['vehicle_uid'] + ' ' + val['vehicle_code'] + ' ' + val['vehicle_name'] );
            });
        });
        var booking_uid  = $(this).data('booking_uid');
        $( "#update_booking_uid" ).val( booking_uid );
        console.log( 'booking_uid: ' + booking_uid );
        $('#modal-booking-update').modal('show');
    });
    $( ".btn-booking-delete" ).on( "click", function( e ) {
        var booking_uid  = $(this).data('booking_uid');
        $( "#delete_booking_uid" ).val( booking_uid );
        $("#booking_delete").submit();
    });
    $('#datepicker-autoclose').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection
