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
      <div class="col-md-3">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h4 class="box-title">Job Status</h4>
          </div>
          <div class="box-body">
            <!-- the events -->
            <div id="external-events">
              <div class="external-event bg-green">{{langMessage('Approved')}}</div>
              <div class="external-event bg-yellow">{{langMessage('Pending')}}</div>
              <div class="external-event bg-light-blue">{{langMessage('Completed')}}</div>
              <div class="external-event bg-red">{{langMessage('Cancelled')}}</div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-body no-padding">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
        <!-- /.box -->
      <!--</div>-->
      <!-- /.col -->
    <!--</div>-->
    <!-- /.row -->
  </section>
@stop
@section('pagejs')
<script type="text/javascript">
$(function(){
  // var date = new Date()
  // var d    = date.getDate(),
  //     m    = date.getMonth(),
  //     y    = date.getFullYear()
  $('#calendar').fullCalendar({
    header    : {
      left  : 'prev,next today',
      center: 'title'
    },
    //Random default events
    events    : {
      url:"{{ route('getcalendarjobs',app()->getLocale()) }}"
    }
  })
})
</script>
@stop
