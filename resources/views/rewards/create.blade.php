@extends('layouts.dashboard')
@section('title', 'Registrar Recompensa')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Registrar Recompensa</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/rewards/index">Recompensas</a></li>
            <li class="breadcrumb-item active">Registrar Recompensa </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/rewards/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Uno</a>
        </div>
    </div>
@endsection
@section('content')
	<form method="POST" action="/rewards/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Recompensa</h3>
            <hr>
            @include('dashboard.alerts')            
            <div class="p-t-20">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if($errors->has('reward_name')) has-danger @endif">
                            <label class="form-control-label">Nombre</label>
                            <input id="reward_name" name="reward_name" class="form-control" placeholder="Nombre de la Recompensa" type="text" value="{{ old('reward_name') }}">
                            @if ($errors->has('reward_name'))
                                @foreach ($errors->get('reward_name') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Ingrese el Nombre del Recompensa</small> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group @if($errors->has('reward_ammount')) has-danger @endif">
                            <label class="form-control-label">Crédito</label>
                            <input id="reward_ammount" name="reward_ammount" class="form-control" placeholder="Crédito de la Recompensa" type="text" value="{{ old('reward_ammount') }}">
                            @if ($errors->has('reward_ammount'))
                                @foreach ($errors->get('reward_ammount') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Ingrese el Crédit </small> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group @if($errors->has('reward_status')) has-danger @endif">
                            <label class="form-control-label">Estatus</label>
                            <select class="custom-select col-12" name="reward_status">
                                <option value="">Seleccione</option>
                                <option @if (old('reward_status') == 1 ) selected=""  @endif value="1">Habilitado</option>
                                <option @if (old('reward_status') == 0 ) selected=""  @endif value="0">Desabilitado</option>
                            </select>
                            @if ($errors->has('reward_status'))
                                @foreach ($errors->get('reward_status') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Seleccione Estatus</small> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group @if($errors->has('reward_description')) has-danger @endif">
                            <label class="form-control-label">Descripción de la Recompensa</label>
                            <input id="reward_description" name="reward_description" class="form-control" placeholder="Descripción de la Recompensa" type="text" value="{{ old('reward_description') }}">
                            @if ($errors->has('reward_description'))
                                @foreach ($errors->get('reward_description') as $error)
                                    <div class="form-control-feedback">{{ $error }}</div>
                                @endforeach
                            @endif
                            <small class="form-control-feedback"> Ingrese la Descripción de la Recompensa</small> 
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->
            </div>                                                  
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/rewards/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection