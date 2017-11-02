@extends('layouts.dashboard')
@section('title', 'Registrar Parqueadero')
@section('breadcrumb')
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-road"></i> Parqueaderos</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/parkings/index">Parqueaderos</a></li>
            <li class="breadcrumb-item active">Registrar Parqueadero </li>
        </ol>
    </div>
    <div class="col-md-4 col-4 align-self-center">
        <div class="button-group">
            <a href="/parkings_lot/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Varios</a>
            <a href="/parkings/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar Uno</a>
        </div>
    </div>
@endsection
@section('content')
	<form method="POST" action="/parkings_lot/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Registrar Parqueaderos</h3>
            <hr>
            @include('dashboard.alerts')
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#required_fields" role="tab" aria-expanded="true"><span><i class="fa fa-asterisk"></i> Requerido</span></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#extra_fields" role="tab" aria-expanded="false"><span><i class="fa fa-plus"></i> Otros</span></a></li>
            </ul>
            <div class="tab-content tabcontent-border">
                <div class="tab-pane active" id="required_fields" role="tabpanel" aria-expanded="true">
                    <div class="p-20">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('vehicle_type_uid')) has-danger @endif">
                                    <label class="form-control-label">Tipo de Vehiculo</label>
                                    <select class="custom-select select2 col-12" name="vehicle_type_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['vehicles_types'] as $r)
                                        <option @if (old('vehicle_type_uid') == $r->vehicle_type_uid ) selected=""  @endif value="{{$r->vehicle_type_uid}}">{{$r->vehicle_type_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vehicle_type_uid'))
                                        @foreach ($errors->get('vehicle_type_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('parking_section_uid')) has-danger @endif">
                                    <label class="form-control-label">Sección</label>
                                    <select class="custom-select select2 col-12" name="parking_section_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['parkings_sections'] as $r)
                                        <option @if (old('parking_section_uid') == $r->parking_section_uid ) selected=""  @endif value="{{$r->parking_section_uid}}">{{$r->parking_section_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parking_section_uid'))
                                        @foreach ($errors->get('parking_section_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Sección</small> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group @if($errors->has('parking_number')) has-danger @endif">
                                    <label class="control-label">Cantidad de Parqueaderos</label>
                                    <input id="parking_number" name="parking_number" class="form-control" placeholder="Cantidad" type="text" value="{{ old('parking_number') }}">
                                    @if ($errors->has('parking_number'))
                                        @foreach ($errors->get('parking_number') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el nombre del Parqueadero</small> 
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group @if($errors->has('parking_name')) has-danger @endif">
                                    <label class="form-control-label">Nombre del la Parqueadero</label>
                                    <input id="parking_name" name="parking_name" class="form-control" placeholder="Nombre del la Parqueadero" type="text" value="{{ old('parking_name') }}">
                                    @if ($errors->has('parking_name'))
                                        @foreach ($errors->get('parking_name') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el nombre del Parqueadero</small> 
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="tab-pane" id="extra_fields" role="tabpanel" aria-expanded="false">
                    <div class="p-20">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('parking_dimension_uid')) has-danger @endif">
                                    <label class="form-control-label">Dimensión del Parqueadero</label>
                                    <select class="custom-select select2 col-12" name="parking_dimension_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['parkings_dimensions'] as $r)
                                        <option @if (old('parking_dimension_uid') == $r->parking_dimension_uid ) selected=""  @endif value="{{$r->parking_dimension_uid}}">{{$r->parking_dimension_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('parking_dimension_uid'))
                                        @foreach ($errors->get('parking_dimension_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Dimensión</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('parking_description')) has-danger @endif">
                                    <label class="form-control-label">Descripción del Parqueadero</label>
                                    <input id="parking_description" name="parking_description" class="form-control" placeholder="Descripción del Parqueadero" type="text" value="{{ old('parking_description') }}">
                                    @if ($errors->has('parking_description'))
                                        @foreach ($errors->get('parking_description') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese la descripción del Parqueadero</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('parking_photo')) has-danger @endif">
                                    <label class="form-control-label">Foto</label>
                                    <input type="file" name="parking_photo" />
                                    @if ($errors->has('parking_photo'))
                                        @foreach ($errors->get('parking_photo') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                </div>
            </div>                                        
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/parkings/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection