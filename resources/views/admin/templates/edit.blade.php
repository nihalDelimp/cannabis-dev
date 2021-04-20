@extends('layouts.default')
@section('content')
  <section class="content-header">
    <h1>
      @lang('dashboard')
      <small>@lang(strtolower($pageHeading))</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('dashboard')</a></li>
      <li class="active">@lang(strtolower($pageHeading))</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">@lang(strtolower($pageHeading))</h3>
          </div>
          <!-- /.box-header -->
    <div class="box-body">
      @if($message = Session::get('success'))
      <div class="alert alert-success">
        <p>@lang(strtolower($message))</p>
      </div>
      @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>@lang(strtolower($error))</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="post" action="{{ route('template.update', ['template'=>$template->id,'locale'=>app()->getLocale()]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
        <div class="form-group">
          <label for="petrol_saved">@lang(strtolower('Template Name'))<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="name" value="{{ $template->name }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang(strtolower('Template Name'))" />
          @error('name')
              <span class="text-danger" role="alert">
                  <strong>@lang(strtolower($message))</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">@lang(strtolower('Template Subject'))<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="subject" value="{{ $template->subject }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang(strtolower('Subject'))" />
          @error('subject')
              <span class="text-danger" role="alert">
                  <strong>@lang(strtolower($message))</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">@lang(strtolower('Hint')) (@lang(strtolower('This is a discription of the template before change please read it')))<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="hint" value="{{ $template->hint }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('Hint')" />
          @error('hint')
              <span class="text-danger" role="alert">
                  <strong>@lang(strtolower($message))</strong>
              </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="petrol_saved">@lang(strtolower('English Message'))<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="message_en" rows="8" cols="80" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('English Message')">{{ $template->message_en }}</textarea>
          @error('message_en')
              <span class="text-danger" role="alert">
                  <strong>@lang(strtolower($message))</strong>
              </span>
          @enderror
        </div>
        <!-- <div class="form-group">
          <label for="petrol_saved">@lang(strtolower('Arabic Message'))<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="message_ar" rows="8" cols="80" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('Arabic Message')">{{ $template->message_ar }}</textarea>
          @error('message_ar')
              <span class="text-danger" role="alert">
                  <strong>@lang(strtolower($message))</strong>
              </span>
          @enderror
        </div> -->
        <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" name="add" type="submit" value="@lang('update')">
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
// $('#warehouse_query').click(function(){
//  if($(this).is(':checked')) {
//   $('.warehouse_location').prop('checked', true);
//  }
//  else {
//   $('.warehouse_location').prop('checked', false);
//  }
// });
</script>
@stop
