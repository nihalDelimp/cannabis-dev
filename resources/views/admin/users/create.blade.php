@extends('layouts.default')
@section('style')

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
@endsection
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
    <form method="post" id="CreateForm" action="{{ route('users.store', app()->getLocale()) }}">
     
      @csrf
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" name="name" required data-parsley-required-message="Please Enter your Name" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Name')}}" />
              @error('name')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('Email')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" name="email" id="email" data-parsley-type="email" required data-parsley-required-message="Please Enter your Email" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your email')}}" />
              @error('email')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          {{-- <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">Production List<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <select  name="event_id" id="event_id"  class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Select Production')}}" />
              <option value="">Select Production </option>
                @foreach($events as $event)
                   <option value="{{$event->id}}">{{$event->name}}</option>
                    
                @endforeach
              </select>
            </div>
          </div> --}}
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('Password')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" name="password" id="password" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" required data-parsley-required-message="Please Enter your Password" placeholder="{{langMessage('Enter your password')}}" />
              @error('password')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('phone')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" name="phone" id="phone" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" required data-parsley-required-message="Please Enter your Phone" data-parsley-type="integer" maxlength="10" minlength="9" placeholder="{{langMessage('Enter your phone number')}}" />
              @error('phone')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('DOB')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="date" name="dob" id="dob" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your dob')}}"  required data-parsley-required-message="Select your DOB">
              @error('dob')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
        
        </div>
        <div class="row">
          
         
          <div class="col-md-4">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Position')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="position">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{$i}}" >Position - {{$i}}</option>
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Organization')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <select class="form-control" name="organization">
                @for ($i = 1; $i <= 4; $i++)
                 
                  <option value="{{$i}}">Organization - {{$i}}</option>
                  
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Instagram Name')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <input type="text" name="instagram_name" id="instagram_name"  class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your Instagram Name')}}" />
              @error('instagram_name')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          {{-- end --}}

        </div>
        
        {{-- <div class="form-group">
          <label for="petrol_saved">{{langMessage('Discription')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <textarea name="discription" rows="8" cols="80" class="form-control textarea border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="@lang('enter your discription')">{{langMessage('enter your discription')}} {{ $user->discription}}</textarea>
          @error('discription')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div> --}}
      </div>
      {{-- insterested_status`, `invited_owner` --}}
      {{-- <div class="col-md-12">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Invited Owner')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="invited_owner">
            <option value="1">{{langMessage('Yes')}}</option>
            <option value="0">{{langMessage('No')}}</option>
          </select>
          @error('invited_owner')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Insterested')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="insterested_status">
            <option value="1">{{langMessage('Yes')}}</option>
            <option value="0">{{langMessage('No')}}</option>
          </select>
          @error('status')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        
      </div> --}}
      <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" id="addSave" name="add" type="submit" value="{{langMessage('add')}}">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> 
<script src="{{ asset('dist/parsley/parsley.min.js') }}"></script> 
<script>
  $(document).ready(function(){
    $('#CreateForm').parsley({

    });
    
    $('.select2').select2();
    $('.textarea').wysihtml5();
    ////////////////
    var up_result = new Date();
    console.log("dat-",up_result);
    var up_inc_date = up_result.setDate(up_result.getDate());
    var increse_date = moment(up_inc_date).format('YYYY-MM-DD');  
    $("#start_date").attr({
          "min" : increse_date,
          //"value" : increse_date,         // values (or variables) here
    });
    $(".disableEndTime").attr('disabled',true);
    $('body').on('change','#start_date',function(){

      var result = new Date($(this).val());

      console.log("dat re-",result);
      var increse_date = result.setDate(result.getDate() + 1 );
      var end_date = moment(increse_date).format('YYYY-MM-DD');  
      $("#end_date").attr({
            "min" : end_date,
            //"disabled" : false,
            //"value" : increse_date,         // values (or variables) here
      });
      $(".disableEndTime").attr('disabled',false);
    });

    
  });
  $(document).ready(function(){
        $('#CreateForm').on('submit', function(e){
           // e.preventDefault();
            //alert("hdljflksdf");
            $('#addSave').prop('disabled', true);
            // $(e.originalEvent.submitter).prop('disabled', true);
            $('#addSave').attr('value','Please wait...');
        });
    });
</script>
@stop
