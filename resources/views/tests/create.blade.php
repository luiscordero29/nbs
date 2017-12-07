@extends('layouts.dashboard')
@section('title', 'Registrar Evaluaciones')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-university"></i> Recompensas</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/tests/index') }}">Evaluaciones</a></li>
            <li class="breadcrumb-item active">Registrar Evaluaciones </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="{{ url('/tests/create') }}" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Uno</a>
        </div>
    </div>
@endsection
@section('content')
	<form method="POST" action="{{ url('/tests/store') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Evaluaciones</h3>
            <hr>
            @include('dashboard.alerts')            
            <div class="p-t-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('test_user_uid')) has-danger @endif">
                            <label class="form-control-label">Empleado</label>
                            <select class="custom-select select2 col-12" name="test_user_uid" id="user_number_id" style="width: 100%">
                                <option value="" selected>Seleccione</option>
                                @foreach ($data['users'] as $r)
                                <option @if (old('user_uid') == $r->user_uid ) selected=""  @endif value="{{$r->user_uid}}">{{$r->user_number_id}} {{$r->user_firstname}} {{$r->user_lastname}} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('test_user_uid'))
                                @foreach ($errors->get('test_user_uid') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Empleado</small> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('test_reward_uid')) has-danger @endif">
                            <label class="form-control-label">Recompensa</label>
                            <select class="custom-select select2 col-12" name="test_reward_uid" id="user_number_id" style="width: 100%">
                                <option value="" selected>Seleccione</option>
                                @foreach ($data['rewards'] as $r)
                                <option @if (old('reward_uid') == $r->reward_uid ) selected=""  @endif value="{{$r->reward_uid}}">{{$r->reward_name}} Créditos: {{$r->reward_ammount}} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('test_reward_uid'))
                                @foreach ($errors->get('test_reward_uid') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Recompensa</small> 
                        </div>
                    </div>                      
                    <div class="col-md-3">
                        <div class="form-group @if($errors->has('test_status')) has-danger @endif">
                            <label class="form-control-label">Estatus</label>
                            <select class="custom-select col-12" name="test_status">
                                <option value="">Seleccione</option>
                                <option @if (old('test_status') == 1 ) selected=""  @endif value="1">Habilitado</option>
                                <option @if (old('test_status') == 0 ) selected=""  @endif value="0">Desabilitado</option>
                            </select>
                            @if ($errors->has('test_status'))
                                @foreach ($errors->get('test_status') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Estatus</small> 
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="datepicker-autoclose" class="control-label">Fecha: </label>
                            <div class="input-group">
                                <input name="test_date" class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" type="text" readonly="" 
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
                    <!--/span-->
                </div>
                <!--/row-->
            </div>                                                  
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="{{ url('/tests/index') }}" class="btn btn-inverse">Regresar</a>
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