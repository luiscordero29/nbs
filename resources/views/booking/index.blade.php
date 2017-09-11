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
                                <select id="parking_section_name" class="custom-select select2 col-md-12" name="parking_section_name">
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
                                <th>Id</th>
                                <th>Sección</th>
                                <th>Tipo</th>
                                <th>Parqueadero</th>
                                <th>Dimensión</th>
                                <th>Foto</th>
                                <th class="text-nowrap">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['rows'] as $r)
                                <tr>
                                    <td>{{ $r->parking_id }}</td>
                                    <td>{{ $r->parking_section_name }}</td>
                                    <td>{{ $r->vehicle_type_name }}</td>
                                    <td>
                                        <b>Nombre: </b>{{ $r->parking_name }} <br />
                                        <b>Descripción: </b>{{ $r->parking_description }} <br />
                                    </td>
                                    <td>
                                        <b>Nombre: </b>{{ $r->parking_dimension_name }} <br />
                                        <b>Tamaño: </b>{{ $r->parking_dimension_size }} <br />
                                        <b>Largo: </b>{{ $r->parking_dimension_long }} <br />
                                        <b>Alto: </b>{{ $r->parking_dimension_height }} <br />
                                        <b>Ancho: </b>{{ $r->parking_dimension_width }} <br />
                                    </td>
                                    <td>
                                        @if ($r->parking_photo)
                                            <img src="{{ asset( 'storage/' . $r->parking_photo) }}" width="150px" height="auto">                                
                                        @endif
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="/parkings/show/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye text-inverse m-r-10"></i> </a>
                                        <a href="/parkings/edit/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="/parkings/destroy/{{ $r->parking_id }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>             
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
   
</div>

@endsection
@section('script')
<script type="text/javascript">
    jQuery('#datepicker-autoclose').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
</script>
@endsection
