@extends('layouts.booking')
@section('title', 'Reservas')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item active">Reporte</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <form id="form-booking-search" method="POST" action="{{ url('/tests_report/index') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search" class="control-label">Buscar: </label>
                                <input id="search" name="search" class="form-control" placeholder="Buscar" type="text" value="{{ $data['search'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            @php 

                                $date_array = explode('-',$data['month_first']);
                                $date_array = array_reverse($date_array);   
                                $month_first    = date(implode('/', $date_array));

                                $date_array = explode('-',$data['month_last']);
                                $date_array = array_reverse($date_array);   
                                $month_last    = date(implode('/', $date_array));

                            @endphp
                            <div class="form-group">
                                <label class="control-label">Rango de Fechas</label>
                                <input class="form-control input-daterange-datepicker" name="daterange" value="@php echo $month_first.' - '.$month_last; @endphp" type="text" readonly="">
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
                Rango de Fechas: @php echo $month_first.' - '.$month_last; @endphp
                <hr>
                @include('dashboard.alerts')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Creditos</th>
                            <th class="text-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $r)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Número ID: </b>{{ $r->user_number_id }}
                                        </div>
                                        <div class="col-12">
                                            <b>Número de Empleado: </b>{{ $r->user_number_employee }}
                                        </div>
                                        <div class="col-12">
                                            <b>Apellidos: </b>{{ $r->user_firstname }}
                                        </div>
                                        <div class="col-12">
                                            <b>Nombres: </b>{{ $r->user_lastname }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $r->test_ammount }}
                                </td>                                   
                                <td class="text-nowrap">
                                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                        <a href="{{ url('/tests_report/show/'.$data['month_first'].'/'.$data['month_last'].'/'.$r->user_uid) }}" class="btn btn-sm btn-info btn-booking-update"><i class="fa fa-university"></i> Ver Recompensas</a>
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
@endsection
@section('script')
<script type="text/javascript">
    $('.input-daterange-datepicker').daterangepicker({
        dateLimit: {
                "days": "30"
            },
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Augosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
        },
    "startDate": "@php echo $month_first; @endphp",
    "endDate": "@php echo $month_last; @endphp"
    }, 
    function(start, end, label) {
          console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
</script>
@endsection
