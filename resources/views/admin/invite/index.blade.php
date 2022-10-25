@extends('layouts.default')
<style type="text/css">
  .parsley-errors-list {
  list-style: none;
  color: rgb(248, 0, 0);
  padding: 0;
  }
  .parsley-required li{
  font-size: 14px;
  line-height: 18px;
  color: red;
  margin-top: 6px;
  }
</style>
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
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">{{langMessage('search')}}</h3>
        </div>
        <div class="box-body">
          <form id="sendInvoice" action="{{ route('invite.send', app()->getLocale())}}" method="post">
            @csrf
            <div class="row">
              <div class="form-group col-sm-6 col-md-4">
                <label for="petrol_saved">Select Event<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <select class="form-control event_select2"  name="event_id" required data-parsley-required-message="Please Select Event">
                    <option value="">-Select Event-</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->name}}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group col-sm-6 col-md-4">
                <label for="petrol_saved">User List<i class="fa fa-star text-red" aria-hidden="true"></i></label>
                  <select class="form-control select2"  name="user_id[]" multiple="multiple" required data-parsley-required-message="Please Select User">
                    <option value="">-Select User-</option>
                    @foreach($users as $user)
                        <option value="{{$user->email}}">{{$user->email}}</option>
                    @endforeach
                  </select>
              </div>
            
            </div>

            <div class="row">
              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary" id="addSave">{{langMessage('Send Invite')}}</button>
                {{-- <a href="#" class="btn btn-primary" id="reset">{{langMessage('reset')}}</a> --}}
              </div>
            </div>
          </form>
        </div>
      </div>
      
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
<script src="{{ asset('dist/parsley/parsley.min.js') }}"></script> 
<script>
    
    $(document).ready(function() {
      $('#sendInvoice').parsley({

      });
      $('.event_select2').select2();

    });
    $('.select2').select2({
      createTag: function (params) {

      const value = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
      

      // Don't offset to create a tag if there is no @ symbol
        if (value.test(params.term)===false) {
          // Return null to disable tag creation
          // alert("boom")
          return;
        }


        return {
          id: params.term,
          text: params.term
        }
      },
      tags: true,
      minimumInputLength: 2,
      tokenSeparators: [','],
      
  });
  $(document).ready(function(){
        $('#sendInvoice').on('submit', function(e){
            //alert("hdljflksdf");
            $('#addSave').prop('disabled', true);
            // $(e.originalEvent.submitter).prop('disabled', true);
            $('#addSave').html('Please wait...');
        });
    });
</script>
@stop
