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
    <form method="post" action="{{ route('category.update', ['category'=>$category->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="col-md-6">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Category Title')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="title" value="{{ $category->title }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Category Title')}}" />
          @error('title')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Category Type')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="post_type">
            <option value="1" {{$category->post_type == '1' ? 'selected' : '' }}>{{langMessage('News')}}</option>
            <option value="2" {{$category->post_type == '2' ? 'selected' : '' }}>{{langMessage('Video')}}</option>
          </select>
          @error('post_type')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div><div class="form-group">
          <label for="petrol_saved">{{langMessage('Description')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="description" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('enter description')">{{ $category->description }}</textarea>
          @error('description')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Status')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="status">
            <option value="1" {{$category->status == '1' ? 'selected' : '' }}>{{langMessage('Active')}}</option>
            <option value="2" {{$category->status == '2' ? 'selected' : '' }}>{{langMessage('Inactive')}}</option>
          </select>
          @error('status')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
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
