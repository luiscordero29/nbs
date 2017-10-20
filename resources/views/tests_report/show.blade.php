@extends('layouts.booking')
@section('title', 'Reservas')
@section('breadcrumb')
    <div class="col-md-12 col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/tests_report/index">Reporte</a></li>
            <li class="breadcrumb-item active">Detalle</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
                <h4>Datos del usuario</h4>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <b>Número ID: </b>{{ $data['row']->user_number_id }}
                    </div>
                    <div class="col-6">
                        <b>Número de Empleado: </b>{{ $data['row']->user_number_employee }}
                    </div>
                    <div class="col-6">
                        <b>Apellidos: </b>{{ $data['row']->user_firstname }}
                    </div>
                    <div class="col-6">
                        <b>Nombres: </b>{{ $data['row']->user_lastname }}
                    </div>
                    <div class="col-4">
                        <b>Tipo: </b>{{ $data['row']->user_type_description }}
                    </div> 
                    <div class="col-4">
                        <b>División: </b>{{ $data['row']->user_division_description }}
                    </div> 
                    <div class="col-4">
                        <b>Cargo: </b>{{ $data['row']->user_position_description }}
                    </div>   
                    <div class="col-8">
                        <b>E-mail: </b>{{ $data['row']->email }}<br />
                    </div>
                    <div class="col-4">
                        <b>Rol: </b>{{ $data['row']->rol_description }}<br />
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
                <h4> Recompensas</h4>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Crédito</th>
                            <th class="text-nowrap">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $r)
                            <tr>
                                <td>
                                    {{ $r->test_date }}                            
                                </td>
                                <td>
                                    {{ $r->reward->reward_name }}                            
                                </td>
                                <td>
                                    {{ $r->test_ammount }}
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