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
                <form method="POST" action="/booking/index">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search" class="control-label">Buscar: </label>
                                <input id="search" name="search" class="form-control" placeholder="Buscar" type="text" value="{{ old('parking_dimension_name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label for="parking_section_name-text-input" class="control-label">Sección: </label>
                                <select id="parking_section_name" class="custom-select col-md-12" name="parking_section_name">
                                    @foreach ($data['parkings_sections'] as $r)
                                    <option @if ($data['parking_section']->parking_section_name == $r->parking_section_name ) selected=""  @endif value="{{$r->parking_section_name}}">{{$r->parking_section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="datepicker-autoclose" class="control-label">Fecha: </label>
                                <div class="input-group">
                                    <input class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" type="text" readonly="" 
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
                                    
                                </td>
                                <td>
                                      
                                </td>                                   
                                <td class="text-nowrap">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        <button type="button" class="btn btn-sm btn-success btn-booking-create" data-parking_id="{{ $r->parking_id }}"><i class="fa fa-car"></i> Asignar</button>
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
<div id="modal-booking-create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-booking-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Asignar Reservar</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="/parkings/store">
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Empleado</label>
                            <select class="custom-select select2" name="user_number_id" id="booking_user_number_id" style="width: 100%">
                                <option value="">Seleccione</option>
                                @foreach ($data['users'] as $r)
                                <option @if (old('user_number_id') == $r->user_number_id ) selected=""  @endif value="{{$r->user_number_id}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                @endforeach
                            </select>
                            <small class="form-control-feedback"> Seleccione Empleado</small> 
                        </div>
                        <div class="form-group">
                            <label class="control-label">Vehiculo</label>
                            <select class="custom-select select2" name="vehicle_brand_name" id="booking_vehicle_brand_name" style="width: 100%">
                                <option value="">Seleccione</option>
                            </select>
                            <small class="form-control-feedback"> Seleccione Vehiculo</small> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div>
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
    $( ".btn-booking-create" ).on( "click", function( e ) {
        var parking_id  = $(this).data('parking_id');
        $('#modal-booking-create').modal('show')
    });
    $('#datepicker-autoclose').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection
