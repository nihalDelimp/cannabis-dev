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
        <div class="box box-primary">
          <div class="box-body no-padding">

          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-body no-padding">

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

</script>
@stop
