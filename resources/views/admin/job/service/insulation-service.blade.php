<div class="form-group col-sm-12">
  <h4 class="box-title">{{langMessage('Scope of Work:')}}</h4>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group insulation_job_day">
<label for="cell_number">{{langMessage('Job Duration:*')}}</label><br>
<input type="hidden" name="qes[1]" value="{{langMessage('Job Duration')}}">
<label class="radio-inline">
<input type="radio" required name="ans[1]" @if(!empty($value[1])){{ $value[1] == langMessage('1 Day') ? 'checked' : '' }} @else {{ old('ans[1]') == langMessage('1 Day') ? 'checked' : '' }} @endif value="{{langMessage('1 Day')}}">{{langMessage('1 Day')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[1]" @if(!empty($value[1])){{ $value[1] == langMessage('2 Day') ? 'checked' : '' }} @else {{ old('ans[1]') == langMessage('2 Day') ? 'checked' : '' }} @endif value="{{langMessage('2 Day')}}">{{langMessage('2 Day')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group insulation_day_2" @if(empty($value[2])) style="display:none;" @endif>
<strong>{{langMessage('All 2 Day Jobs MUST be completed within 2 weeks')}}</strong>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group insulation_day_2" @if(empty($value[2])) style="display:none;" @endif>
<label for="">{{langMessage('Day 2 schedule date:')}}</label>
<input type="hidden" name="qes[2]" value="{{langMessage('Day 2 schedule date')}}">
<input class="form-control" name="ans[2]"   @if(!empty($value[2]))  value="{{ $value[2] }}" @else value="{{ old('ans[2]') }}" @endif type="text" id="schedule_date" placeholder="" autocomplete="off">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Zillow Square Footage:')}}</label>
<input type="hidden" name="qes[3]" value="{{langMessage('Zillow Square Footage')}}">
<input class="form-control" name="ans[3]"  @if(!empty($value[3]))  value="{{ $value[3] }}" @else value="{{ old('ans[3]') }}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Knob and tube wiring Present?')}}*</label><br>
<input type="hidden" name="qes[4]" value="{{langMessage('Knob and tube wiring Present?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value[4])){{$value[4]==langMessage('Yes')?'checked':''}} @else{{old('ans[4]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value[4])){{$value[4]==langMessage('No')?'checked':''}} @else{{old('ans[4]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value[4])){{$value[4]==langMessage('Inactive')?'checked':''}} @else{{old('ans[4]')==langMessage('Inactive')?'checked':''}}@endif value="{{langMessage('Inactive')}}">{{langMessage('Inactive')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group insulation-service-type">
<label for="cell_number">{{langMessage('Insulation service')}}</label><br>
<input type="hidden" name="qes[5]" value="{{langMessage('Insulation service')}}">
<label class="checkbox-inline">
<input type="checkbox" data-file="option_one" name="ans[5][0]" @if(!empty($value[5][0])){{$value[5][0]==langMessage('Attic insulation removal & sanitize')?'checked':''}} @else{{old('ans[5][0]')==langMessage('Attic insulation removal & sanitize')?'checked':''}}@endif value="{{langMessage('Attic insulation removal & sanitize')}}">{{langMessage('Attic insulation removal & sanitize')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_two" name="ans[5][1]" @if(!empty($value[5][1])){{$value[5][1]==langMessage('Attic insulation install')?'checked':''}} @else{{old('ans[5][1]')==langMessage('Attic insulation install')?'checked':''}}@endif value="{{langMessage('Attic insulation install')}}">{{langMessage('Attic insulation install')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_three" name="ans[5][2]" @if(!empty($value[5][2])){{$value[5][2]==langMessage('Attic air sealing')?'checked':''}} @else{{old('ans[5][2]')==langMessage('Attic air sealing')?'checked':''}}@endif value="{{langMessage('Attic air sealing')}}">{{langMessage('Attic air sealing')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_four" name="ans[5][3]" @if(!empty($value[5][3])){{$value[5][3]==langMessage('Attic radiant barrier')?'checked':''}} @else{{old('ans[5][3]')==langMessage('Attic radiant barrier')?'checked':''}}@endif value="{{langMessage('Attic radiant barrier')}}">{{langMessage('Attic radiant barrier')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_five" name="ans[5][4]" @if(!empty($value[5][4])){{$value[5][4]==langMessage('Subfloor insulation removal & sanitize')?'checked':''}} @else{{old('ans[5][4]')==langMessage('Subfloor insulation removal & sanitize')?'checked':''}}@endif value="{{langMessage('Subfloor insulation removal & sanitize')}}">{{langMessage('Subfloor insulation removal & sanitize')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_six" name="ans[5][5]" @if(!empty($value[5][5])){{$value[5][5]==langMessage('Subfloor insulation install')?'checked':''}} @else{{old('ans[5][5]')==langMessage('Subfloor insulation install')?'checked':''}}@endif value="{{langMessage('Subfloor insulation install')}}">{{langMessage('Subfloor insulation install')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_seven" name="ans[5][6]" @if(!empty($value[5][6])){{$value[5][6]==langMessage('Attic kneewall removal')?'checked':''}} @else{{old('ans[5][6]')==langMessage('Attic kneewall removal')?'checked':''}}@endif value="{{langMessage('Attic kneewall removal')}}">{{langMessage('Attic kneewall removal')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_eight" name="ans[5][7]" @if(!empty($value[5][7])){{$value[5][7]==langMessage('Attic kneewall install')?'checked':''}} @else{{old('ans[5][7]')==langMessage('Attic kneewall install')?'checked':''}}@endif value="{{langMessage('Attic kneewall install')}}">{{langMessage('Attic kneewall install')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_nine" name="ans[5][8]" @if(!empty($value[5][8])){{$value[5][8]==langMessage('Wall insulation install')?'checked':''}} @else{{old('ans[5][8]')==langMessage('Wall insulation install')?'checked':''}}@endif value="{{langMessage('Wall insulation install')}}">{{langMessage('Wall insulation install')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" data-file="option_ten" name="ans[5][9]" @if(!empty($value[5][9])){{$value[5][9]==langMessage('Subfloor vacuum & disinfect')?'checked':''}} @else{{old('ans[5][9]')==langMessage('Subfloor vacuum & disinfect')?'checked':''}}@endif value="{{langMessage('Subfloor vacuum & disinfect')}}">{{langMessage('Subfloor vacuum & disinfect')}}
</label>
</div>
<div id="insulation-options-question-container">

</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Price:')}}</label>
<input type="hidden" name="qes[6]" value="{{langMessage('Price')}}">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
<input class="form-control" name="ans[6]" @if(!empty($value[6])) value="{{$value[6]}}" @else value="{{old('ans[6]')}}" @endif type="text" id="job_price" placeholder="">
</div>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Special Instructions:')}}</label>
<input type="hidden" name="qes[7]" value="{{langMessage('Special Instructions')}}">
<textarea class="form-control textarea" name="ans[7]" rows="8" cols="80" id="">  @if(!empty($value[7]))  {{ $value[7] }} @else {{ old('ans[7]') }} @endif</textarea>
</div>

<script type="text/javascript">
  // $("#job_price").blur(function() {
  //   this.value = parseFloat(this.value).toFixed(2);
  // });
  $('#job_price').bind('paste', function () {
      var self = this;
      setTimeout(function () {
          if (!/^\d*(\.\d{1,2})+$/.test($(self).val())) $(self).val('');
      }, 0);
  });
  $('#job_price').keypress(function (e) {
      var character = String.fromCharCode(e.keyCode)
      var newValue = this.value + character;
      if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
          e.preventDefault();
          return false;
      }
  });
  function hasDecimalPlace(value, x) {
      var pointIndex = value.indexOf('.');
      return  pointIndex >= 0 && pointIndex < value.length - x;
  }
  $('.textarea').wysihtml5();
  $("#schedule_date").datepicker({
    minDate:0,
    maxDate: "+2M",
    dateFormat:"yy-mm-dd",
    beforeShowDay: $.datepicker.noWeekends
  });

  var includeInsulationOption = function(insulation_option){
    $.ajax({
      url:'{{ route("getinsulationoptionform",app()->getLocale()) }}',
      method:'post',
      data:{insulation_option:insulation_option},
      beforeSend: function(){
      },
      success: function(json){
        $("#insulation-options-question-container").append(json);
      }
    })
  }

  var includeInsulationOptionEdit = function(insulation_option,value){
    $.ajax({
      url:'{{ route("getinsulationoptionform",app()->getLocale()) }}',
      method:'post',
      data:{insulation_option:insulation_option,value:value},
      beforeSend: function(){
      },
      success: function(json){
        $("#insulation-options-question-container").append(json);
      }
    })
  }

  @if(!empty($value))
  @foreach($insulations as $insulation)
    @if(isset($insulation["insulation_option"]))
      includeInsulationOptionEdit('option_{{$insulation["insulation_option"]}}','{!!json_encode($insulation)!!}');
    @endif
  @endforeach
  @endif

  $(".insulation-service-type input[type=checkbox]").on('change', function(){
    var data = {};
    if($(this).prop("checked") == true){
      if($(this).attr('data-file') != 'option_three'){
          includeInsulationOption($(this).attr('data-file'));
      }
    }
    else if($(this).prop("checked") == false){
      $("#"+$(this).attr('data-file')).remove();
    }
  });

  $(".insulation_job_day input").on('change', function(){
    var selectedDay = $(this).val();
    if(selectedDay == '2 Day'){
      $(".insulation_day_2").show();
      $(".insulation_day_2 input").attr('required','required');
    }
    else{
      $(".insulation_day_2").hide();
      $(".insulation_day_2 input").removeAttr('required');
    }
  });
</script>
