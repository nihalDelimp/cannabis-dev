<div class="" id="option_two">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Attic insulation install')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group insulation-install-type">
  <label for="cell_number">{{langMessage('What type of insulation to install?')}}</label><br>
  <input type="hidden" name="option_two_qes[1]" value="{{langMessage('What type of insulation to install?')}}">
  <label class="radio-inline">
  <input type="radio" data-value='TAP Insulation' required name="option_two_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('TAP Insulation')?'checked':''}} @else{{old('option_two_ans[1]')==langMessage('TAP Insulation')?'checked':''}}@endif value="{{langMessage('TAP Insulation')}}">{{langMessage('TAP Insulation')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value='Fiberglass' required name="option_two_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Fiberglass')?'checked':''}} @else{{old('option_two_ans[1]')==langMessage('Fiberglass')?'checked':''}}@endif value="{{langMessage('Fiberglass')}}">{{langMessage('Fiberglass')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value='Cellulose' required name="option_two_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Cellulose')?'checked':''}} @else{{old('option_two_ans[1]')==langMessage('Cellulose')?'checked':''}}@endif value="{{langMessage('Cellulose')}}">{{langMessage('Cellulose')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value='Batts' required name="option_two_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Batts')?'checked':''}} @else{{old('option_two_ans[1]')==langMessage('Batts')?'checked':''}}@endif value="{{langMessage('Batts')}}">{{langMessage('Batts')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('What R-value to install?')}}</label><br>
  <input type="hidden" name="option_two_qes[2]" value="{{langMessage('What R-value to install?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R19')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R19')?'checked':''}}@endif value="{{langMessage('R19')}}">{{langMessage('R19')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R30')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R30')?'checked':''}}@endif value="{{langMessage('R30')}}">{{langMessage('R30')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R38')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R38')?'checked':''}}@endif value="{{langMessage('R38')}}">{{langMessage('R38')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R44')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R44')?'checked':''}}@endif value="{{langMessage('R44')}}">{{langMessage('R44')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R49')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R49')?'checked':''}}@endif value="{{langMessage('R49')}}">{{langMessage('R49')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('R60')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('R60')?'checked':''}}@endif value="{{langMessage('R60')}}">{{langMessage('R60')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_two_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('NA')?'checked':''}} @else{{old('option_two_ans[2]')==langMessage('NA')?'checked':''}}@endif value="{{langMessage('NA')}}">{{langMessage('NA')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group option_two_qes_3" @if(empty($value[3])) style="display:none" @endif>
  <label for="">{{langMessage('Number of can lights')}}</label>
  <input type="hidden" name="option_two_qes[3]" value="{{langMessage('Number of can lights')}}" @if(empty($value[3])) disabled @endif>
  <input class="form-control" name="option_two_ans[3]" @if(empty($value[3])) disabled @endif   @if(!empty($value[3]))  value="{{ $value[3] }}" @else value="{{ old('option_two_ans[3]') }}" @endif type="text" id="" placeholder="">
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group option_two_qes_4" @if(empty($value[4])) style="display:none" @endif>
  <label for="">{{langMessage('What are the attic on centers?:')}}</label>
  <input type="hidden" name="option_two_qes[4]" @if(empty($value[4])) disabled @endif value="{{langMessage('What are the attic on centers?')}}">
  <input class="form-control" name="option_two_ans[4]" @if(empty($value[4])) disabled @endif   @if(!empty($value[4]))  value="{{ $value[4] }}" @else value="{{ old('option_two_ans[4]') }}" @endif type="text" id="" placeholder="">
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Attic square footage to be installed')}}</label>
  <input type="hidden" name="option_two_qes[5]" value="{{langMessage('Attic square footage to be installed')}}">
  <input class="form-control" name="option_two_ans[5]"   @if(!empty($value[5]))  value="{{ $value[5] }}" @else value="{{ old('option_two_ans[5]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
$("body .insulation-install-type input[type=radio]").on('change', function(){
  var values = $(this).attr('data-value');
  if(values == "TAP Insulation" || values == "Fiberglass" || values == "Cellulose"){
    $(".option_two_qes_3").show();
    $(".option_two_qes_4").hide();
    $(".option_two_qes_4 input").attr('disabled','disabled');
    $(".option_two_qes_3 input").removeAttr('disabled');
  }
  else{
    $(".option_two_qes_3").hide();
    $(".option_two_qes_4").show();
    $(".option_two_qes_3 input").attr('disabled','disabled');
    $(".option_two_qes_4 input").removeAttr('disabled');
  }
});
</script>
