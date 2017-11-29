@extends('layouts.auth')
@section('title', 'Iniciar Sesión')
@section('content')
    <form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <a href="/login" class="text-center db">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Nidoo Business Solutions" />
        </a>  
        <br />
        <br />
        @include('dashboard.alerts')
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
        @endif
        {{-- Helper::shout('this is how to use autoloading correctly!!') --}}
        <div class="form-group m-t-40">
            <div class="col-xs-12">
                <input id="email" type="text" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox checkbox-primary pull-left p-t-0">
                    <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="checkbox-signup"> Recordarme </label>
                </div>
            </div>
        </div>
        <div class="form-group text-center m-t-20">
            <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Iniciar Sesión</button>
            </div>
        </div>
        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Recuperar Clave
                </a>
            </div>
        </div>
    </form>
@endsection