@extends('layouts.plan')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{url(route('admin',app()->getLocale()))}}"><img src="{{ asset('logo.png')}}" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">@lang('sign in to start your session')</p>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang(strtolower($error))</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>@lang(strtolower($message))</strong>
      </div>
    @endif
    <form id="loginForm" action="{{ route('adminLogin',app()->getLocale()) }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" value="{{ old('email') }}" class="form-control  @error('email') is-invalid @enderror" placeholder="@lang(strtolower('Email'))" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>@lang(strtolower($message))</strong>
            </span>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" value="{{old('password')}}"  class="form-control  @error('password') is-invalid @enderror" placeholder="@lang(strtolower('Password'))" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>@lang(strtolower($message))</strong>
            </span>
        @enderror
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="hidden" name="goto" value="{{$goto}}">
          <button type="submit" id="loginForm-btn" class="main-btn btn btn-primary btn-block btn-flat">@lang(strtolower('Login'))</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div class="forgot-login">
      <a href="{{ route('login.forgotpassword',app()->getLocale()) }}">@lang(strtolower('Forgot Password ?'))</a>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
@stop
