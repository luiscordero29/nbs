@extends('layouts.auth')
@section('title', 'Recuperar Clave')
@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <a href="/login" class="text-center db">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Nidoo Business Solutions" />
        </a>  
        <br />
        <br />
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group m-t-40">
            <div class="col-xs-12">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Recuperar Clave</button>
            </div>
        </div>
    </form>
@endsection
