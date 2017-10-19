@extends('layouts.dashboard')
@section('title', 'Editar Recompensa')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Editar Recompensa</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/tests/index">Recompensas</a></li>
            <li class="breadcrumb-item active">Editar Recompensa </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/tests/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
        </div>
    </div>
@endsection
@section('content')
	<form method="POST" action="/tests/update/{{ $data['row']->test_uid }}"  enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Editar Recompensa</h3>
            <hr>
            @include('dashboard.alerts')
            <div class="p-t-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('tests_user_uid')) has-danger @endif">
                            <label class="form-control-label">Empleado</label>
                            <select class="custom-select select2 col-12" name="tests_user_uid" id="user_number_id" style="width: 100%">
                                <option value="" selected>Seleccione</option>
                                @foreach ($data['users'] as $r)
                                <option @if ($data['row']->user_uid == $r->user_uid ) selected=""  @endif value="{{$r->user_uid}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tests_user_uid'))
                                @foreach ($errors->get('tests_user_uid') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Empleado</small> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('tests_reward_uid')) has-danger @endif">
                            <label class="form-control-label">Recompensa</label>
                            <select class="custom-select select2 col-12" name="tests_reward_uid" id="user_number_id" style="width: 100%">
                                <option value="" selected>Seleccione</option>
                                @foreach ($data['rewards'] as $r)
                                <option @if ($data['row']->reward_uid == $r->reward_uid ) selected=""  @endif value="{{$r->reward_uid}}">{{$r->reward_name}} Créditos: {{$r->reward_ammount}} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('tests_reward_uid'))
                                @foreach ($errors->get('tests_reward_uid') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Recompensa</small> 
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="datepicker-autoclose" class="control-label">Fecha: </label>
                            <div class="input-group">
                                <input name="test_date" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" type="text" readonly="" 
                                value="@php 
                                    $date_array = explode('-',$data['row']->test_date);
                                    $date_array = array_reverse($date_array);   
                                    $date    = date(implode('/', $date_array));
                                    echo $date;
                                @endphp">
                                <span class="input-group-addon"><i class="icon-calender"></i></span> 
                            </div>
                        </div>
                    </div>              
                    <!--/span-->
                </div>
                <!--/row-->
            </div>           
            <!--/row-->                                        
        </div>
        <div class="form-actions  p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/tests/index" class="btn btn-inverse">Regresar</a>
            <input type="hidden" name="test_id" value="{{ $data['row']->test_id }}">
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
        $('#datepicker-autoclose').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    </script>
@endsection