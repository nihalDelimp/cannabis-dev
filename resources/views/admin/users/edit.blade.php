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
    <form method="post" action="{{ route('users.update', [app()->getLocale(),$user->id]) }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="col-md-12">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Name')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <input type="text" name="name" value="{{ $user->name }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Name')}}" />
          @error('name')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('Email')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" disabled name="email" id="email" value="{{$user->email}}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your email')}}" />
              @error('email')
                  <span class="text-danger" role="alert">
                      <strong>{{langMessage($message)}}</strong>
                  </span>
              @enderror
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              
              <label for="petrol_saved">{{langMessage('phone')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
              <input type="text" disabled name="phone" id="phone" value="{{$user->phone}}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your phone number')}}" />
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
              <input type="date" disabled name="dob" id="dob" value="{{\Carbon\Carbon::parse($user->dob)->format('Y-m-d') }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your dob')}}" />
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
                <option value="{{$i}}" {{$i == $user->position ? 'selected':''}}>Position - {{$i}}</option>
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
                 
                  <option value="{{$i}}" {{ $i == $user->organization ? 'selected':''}}>Organization - {{$i}}</option>
                  
                @endfor
              </select>
             </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="petrol_saved">{{langMessage('Instagram Name')}}
                <i class="fa fa-star text-red" aria-hidden="true"></i>
              </label>
              <input type="text" name="instagram_name" id="instagram_name" value="{{ $user->instagram_name }}" class="form-control border-0 rounded-0 primary-text-color py-2 pl-3" placeholder="{{langMessage('Enter your Instagram Name')}}" />
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
            <option value="1" {{ $user->insterested_status == '1' ?'selected':''}}>{{langMessage('Yes')}}</option>
            <option value="0" {{ $user->insterested_status == '0' ?'selected':''}}>{{langMessage('No')}}</option>
          </select>
          @error('invited_owner')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
      </div> --}}
      {{-- <div class="col-md-12">
        <div class="form-group">
          <label for="petrol_saved">{{langMessage('Insterested')}}<i class="fa fa-star text-red" aria-hidden="true"></i></label>
          <select class="form-control" name="insterested_status">
            <option value="1" {{ $user->insterested_status == '1' ?'selected':''}}>{{langMessage('Yes')}}</option>
            <option value="0" {{ $user->insterested_status == '0' ?'selected':''}}>{{langMessage('No')}}</option>
          </select>
          @error('status')
              <span class="text-danger" role="alert">
                  <strong>{{langMessage($message)}}</strong>
              </span>
          @enderror
        </div>
      </div> --}}
      <div class="form-group col-sm-12 text-center">
        <input class="btn btn-primary" name="add" type="submit" value="{{langMessage('update')}}">
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


  var up_result = new Date($('#start_date').val());
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
</script>
@stop
