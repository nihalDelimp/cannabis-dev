@extends('layouts.plan')
@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{url(route('admin',app()->getLocale()))}}"><img src="{{ asset('logo.png')}}" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">@lang(strtolower('Insert your registered email address'))</p>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang(strtolower($error))</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>@lang(strtolower($message))</strong>
      </div>
    @endif
    <form id="loginForm" action="{{ route('login.processforgotpass',app()->getLocale()) }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="@lang(strtolower('Email'))" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="loginForm-btn" class="main-btn btn btn-primary btn-block btn-flat">@lang(strtolower('Submit'))</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <div class="forgot-login">
      <a href="{{url(route('admin',app()->getLocale()))}}" >@lang(strtolower('Login'))</a><br>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>
@stop
