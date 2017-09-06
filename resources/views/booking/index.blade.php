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
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Sección: </label>
                                        <div class="col-10">
                                            <select class="custom-select select2 col-10" name="parking_section_name">
                                                @foreach ($data['parkings_sections'] as $r)
                                                <option @if ($data['parking_section']->parking_section_name == $r->parking_section_name ) selected=""  @endif value="{{$r->parking_section_name}}">{{$r->parking_section_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Fecha: </label>
                                        <div class="col-10">
                                            <div class="input-group">
                                                <input class="form-control" id="datepicker-autoclose" placeholder="dd/mm/yyyy" type="text" readonly="" value="{{ $data['today'] }}">
                                                <span class="input-group-addon"><i class="icon-calender"></i></span> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-success btn-block waves-effect waves-light m-r-10">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @for ($i = 0; $i < 6; $i++)
        <div class="col-2">
            <div class="card">
                <div class="card-block">
                    @week($data['today'])
                </div>
            </div>
        </div>
    @endfor
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
