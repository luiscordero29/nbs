@extends('layouts.dashboard')
@section('title', 'Recompensas')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item active">Recompensas </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/rewards/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
        </div>
    </div>
@endsection
@section('content')
	<div class="row">
        <div class="col-9">
            <h3 class="card-title">Lista de Recompensas</h3>
        </div>
        <div class="col-3">
            <form method="POST" action="/rewards/index">
                {{ csrf_field() }}
                <div class="form-group">
                    <input id="search" name="search" class="form-control" placeholder="Buscar" type="text" 
                        @if (session('search'))
                            value="{{ session('search') }}" 
                        @endif
                    >
                </div>
            </form>
        </div>
    </div>
    @include('dashboard.alerts')
	<div class="table-responsive">
       	<table class="table table-bordered">
            <thead>
                <tr>
                    <th>Recompensa</th>
                    <th>Crédito</th>
                    <th>Estatus</th>
                    <th class="text-nowrap"></th>
                </tr>
            </thead>
            <tbody>
                @isset($data['rows']    )
    			@foreach ($data['rows'] as $r)
                    <tr>
                        <td>{{ $r->reward_name }}</td>
                        <td>{{ $r->reward_ammount }}</td>
                        <td>
                            @if($r->reward_status)
                                Habilidato
                            @else
                                Desabilitado
                            @endif
                        </td>
                        <td class="text-nowrap">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a class="btn btn-secondary" href="/rewards/show/{{ $r->reward_uid }}" data-toggle="tooltip" data-original-title="Ver"> <i class="fa fa-eye"></i> </a>
                                <a class="btn btn-secondary" href="/rewards/edit/{{ $r->reward_uid }}" data-toggle="tooltip" data-original-title="Editar"> <i class="fa fa-pencil"></i> </a>
                                <a class="btn btn-secondary" href="/rewards/destroy/{{ $r->reward_uid }}" data-toggle="tooltip" data-original-title="Eliminar"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        </td>
                    </tr>             
				@endforeach
                @endisset
             	</tbody>
        </table>
    </div>
    {{ $data['rows']->links() }}
@endsection