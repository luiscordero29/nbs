@extends('layouts.dashboard')
@section('title', 'Registrar Usuario')
@section('breadcrumb')
    <div class="col-md-9 col-9 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0"><i class="fa fa-users"></i> Usuarios</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Administración</a></li>
            <li class="breadcrumb-item"><a href="/users/index">Usuarios</a></li>
            <li class="breadcrumb-item active">Registrar Usuario </li>
        </ol>
    </div>
    <div class="col-md-3 col-3 align-self-center">
        <a href="/users/create" class="btn pull-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Registrar</a>
    </div>
@endsection
@section('content')
    <form method="POST" action="/users/store" enctype="multipart/form-data">
		{{ csrf_field() }}
        <div class="form-body">
            <h3 class="card-title">Datos del Usuario</h3>
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
                                <div class="form-group @if($errors->has('user_number_id')) has-danger @endif">
                                    <label for="user_number_id" class="form-control-label">Número ID</label>
                                    <input id="user_number_id" name="user_number_id" class="form-control" placeholder="Número ID" type="text" value="{{ old('user_number_id') }}">
                                    @if ($errors->has('user_number_id'))
                                        @foreach ($errors->get('user_number_id') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el Número ID</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('user_number_employee')) has-danger @endif">
                                    <label for="user_number_employee" class="form-control-label">Número de Empleado</label>
                                    <input id="user_number_employee" name="user_number_employee" class="form-control" placeholder="Número de Empleado" type="text" value="{{ old('user_number_employee') }}">
                                    @if ($errors->has('user_number_employee'))
                                        @foreach ($errors->get('user_number_employee') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el Número de Empleado</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('user_firstname')) has-danger @endif">
                                    <label for="user_firstname" class="form-control-label">Apellidos</label>
                                    <input id="user_firstname" name="user_firstname" class="form-control" placeholder="Apellidos" type="text" value="{{ old('user_firstname') }}">
                                    @if ($errors->has('user_firstname'))
                                        @foreach ($errors->get('user_firstname') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese los Apellidos</small> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group @if($errors->has('user_lastname')) has-danger @endif">
                                    <label for="user_lastname" class="form-control-label" @if($errors->has('user_lastname')) has-danger @endif>Nombres</label>
                                    <input id="user_lastname" name="user_lastname" class="form-control" placeholder="Nombres" type="text" value="{{ old('user_lastname') }}">
                                    @if ($errors->has('user_lastname'))
                                        @foreach ($errors->get('user_lastname') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese los Nombres</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('email')) has-danger @endif">
                                    <label class="form-control-label">E-mail</label>
                                    <input id="email" name="email" class="form-control" placeholder="Nombres" type="text" value="{{ old('email') }}">
                                    @if ($errors->has('user_lastname'))
                                        @foreach ($errors->get('user_lastname') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Ingrese el E-mail</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('role_uid')) has-danger @endif">
                                    <label for="role_uid" class="form-control-label">Rol</label>
                                    <select class="custom-select select2" name="role_uid" id="role_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['roles'] as $r)
                                        <option @if (old('role_uid') == $r->role_uid ) selected=""  @endif value="{{$r->role_uid}}">{{$r->role_description}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role_uid'))
                                        @foreach ($errors->get('role_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Rol</small> 
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="extra_fields" role="tabpanel" aria-expanded="false">
                    <div class="p-20">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('users_user_type_uid')) has-danger @endif">
                                    <label class="form-control-label">Tipo</label>
                                    <select id="users_user_type_uid" class="custom-select select2" name="users_user_type_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['users_types'] as $r)
                                        <option @if (old('users_user_type_uid') == $r->user_type_uid ) selected=""  @endif value="{{$r->user_type_uid}}">{{$r->user_type_description}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('users_user_type_uid'))
                                        @foreach ($errors->get('users_user_type_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Tipo</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" @if($errors->has('users_user_division_uid')) has-danger @endif">
                                    <label class="form-control-label">División</label>
                                    <select class="custom-select select2" name="users_user_division_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['users_divisions'] as $r)
                                        <option @if (old('users_user_division_uid') == $r->user_division_uid ) selected=""  @endif value="{{$r->user_division_uid}}">{{$r->user_division_description}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('users_user_division_uid'))
                                        @foreach ($errors->get('users_user_division_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione División</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('users_user_position_uid')) has-danger @endif">
                                    <label class="form-control-label">Cargo</label>
                                    <select class="custom-select select2" name="users_user_position_uid" style="width: 100%">
                                        <option value="">Seleccione</option>
                                        @foreach ($data['users_positions'] as $r)
                                        <option @if (old('users_user_position_uid') == $r->user_position_uid ) selected=""  @endif value="{{$r->user_position_uid}}">{{$r->user_position_description}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('users_user_position_uid'))
                                        @foreach ($errors->get('users_user_position_uid') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                    <small class="form-control-feedback"> Seleccione Cargo</small> 
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group @if($errors->has('user_image')) has-danger @endif">
                                    <label class="form-control-label">Foto</label>
                                    <input type="file" name="user_image" />
                                    @if ($errors->has('user_image'))
                                        @foreach ($errors->get('user_image.*') as $error)
                                            <div class="form-control-feedback">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                    </div>
                </div>
            </div>            
            <!--/row-->                                        
        </div>
        <div class="form-actions p-t-20">
            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Guardar</button>
            <a href="/users/index" class="btn btn-inverse">Regresar</a>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection