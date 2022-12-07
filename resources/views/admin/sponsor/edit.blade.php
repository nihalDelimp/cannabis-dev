@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      {{langMessage('dashboard')}}
      <small>{{langMessage($pageHeading)}}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{langMessage('dashboard')}}</a></li>
      <li class="active">{{langMessage($pageHeading)}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{langMessage($pageHeading)}}</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{langMessage($message)}}</p>
      </div>
      @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{langMessage($error)}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('sponsor.update', ['sponsor'=>$sponsor->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Sponser Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="name" value="{{ $sponsor->name }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Sponser Name')}}" />
          @error('name')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Link')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="link" value="{{ $sponsor->link }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Link')}}" />
          @error('link')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="status">
            <option value="1" {{$sponsor->status == '1' ? 'selected' : '' }}>{{langMessage('Active')}}</option>
            <option value="2" {{$sponsor->status == '2' ? 'selected' : '' }}>{{langMessage('Inactive')}}</option>
          </select>
          @error('status')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Sponser Image')}}</label>
          <input type="file" name="image" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3"/>
          @error('image')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <img src="{{asset('images/sponsors/'.$sponsor->image)}}" width="100" height="100">
        </div>
        <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('Update')}}">
        </div>
      </div>
    </form>
    </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@stop
@section('pagejs')
<script>
  $(document).ready(function(){
    $('.select2').select2();
    $('.textarea').wysihtml5();
  });
</script>
@stop
