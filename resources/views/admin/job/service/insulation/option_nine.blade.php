<div class="" id="option_nine">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Wall insulation install')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group wall-insulation-install-type">
  <label for="cell_number">{{langMessage('Type of wall insulation to install?')}}</label><br>
  <input type="hidden" name="option_nine_qes[1]" value="{{langMessage('Type of wall insulation to install?')}}">
  <label class="radio-inline">
  <input type="radio" data-value="TAP Insulation" required name="option_nine_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('TAP Insulation')?'checked':''}} @else{{old('option_nine_ans[1]')==langMessage('TAP Insulation')?'checked':''}}@endif value="{{langMessage('TAP Insulation')}}">{{langMessage('TAP Insulation')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value="Fiberglass" required name="option_nine_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Fiberglass')?'checked':''}} @else{{old('option_nine_ans[1]')==langMessage('Fiberglass')?'checked':''}}@endif value="{{langMessage('Fiberglass')}}">{{langMessage('Fiberglass')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value="Cellulose" required name="option_nine_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Cellulose')?'checked':''}} @else{{old('option_nine_ans[1]')==langMessage('Cellulose')?'checked':''}}@endif value="{{langMessage('Cellulose')}}">{{langMessage('Cellulose')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value="Batts" required name="option_nine_ans[1]" @if(!empty($value[1])){{$value[1]==langMessage('Batts')?'checked':''}} @else{{old('option_nine_ans[1]')==langMessage('Batts')?'checked':''}}@endif value="{{langMessage('Batts')}}">{{langMessage('Batts')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group option_nine_qes_2"  @if(empty($value[2])) style="display:none" @endif>
  <label for="cell_number">{{langMessage('Are the wall voids exposed?')}}</label><br>
  <input type="hidden" name="option_nine_qes[2]" @if(empty($value[2])) disabled @endif value="{{langMessage('Are the wall voids exposed?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[2]" @if(empty($value[2])) disabled @endif @if(!empty($value[2])){{$value[2]==langMessage('Yes')?'checked':''}} @else{{old('option_nine_ans[2]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[2]" @if(empty($value[2])) disabled @endif @if(!empty($value[2])){{$value[2]==langMessage('No')?'checked':''}} @else{{old('option_nine_ans[2]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group option_nine_qes_3" @if(empty($value[3])) style="display:none" @endif>
  <label for="cell_number">{{langMessage('Wall drill & fill')}}</label><br>
  <input type="hidden" name="option_nine_qes[3]" @if(empty($value[3])) disabled @endif value="{{langMessage('Wall drill & fill')}}">
  <label class="radio-inline">
  <input type="radio" data-value="Through interior" @if(empty($value[3])) disabled @endif required name="option_nine_ans[3]" @if(!empty($value[3])){{$value[3]==langMessage('Through interior')?'checked':''}} @else{{old('option_nine_ans[3]')==langMessage('Through interior')?'checked':''}}@endif value="{{langMessage('Through interior')}}">{{langMessage('Through interior')}}
  </label>
  <label class="radio-inline">
  <input type="radio" data-value="Through exterior" @if(empty($value[3])) disabled @endif required name="option_nine_ans[3]" @if(!empty($value[3])){{$value[3]==langMessage('Through exterior')?'checked':''}} @else{{old('option_nine_ans[3]')==langMessage('Through exterior')?'checked':''}}@endif value="{{langMessage('Through exterior')}}">{{langMessage('Through exterior')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group option_nine_qes_4" @if(empty($value[4])) style="display:none" @endif>
  <label for="cell_number">{{langMessage('What type of exterior?')}}</label><br>
  <input type="hidden" name="option_nine_qes[4]" @if(empty($value[4])) disabled @endif value="{{langMessage('What type of exterior?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[4]" @if(empty($value[4])) disabled @endif @if(!empty($value[4])){{$value[4]==langMessage('Stucco')?'checked':''}} @else{{old('option_nine_ans[4]')==langMessage('Stucco')?'checked':''}}@endif value="{{langMessage('Stucco')}}">{{langMessage('Stucco')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[4]" @if(empty($value[4])) disabled @endif @if(!empty($value[4])){{$value[4]==langMessage('Wood')?'checked':''}} @else{{old('option_nine_ans[4]')==langMessage('Wood')?'checked':''}}@endif value="{{langMessage('Wood')}}">{{langMessage('Wood')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[4]" @if(empty($value[4])) disabled @endif @if(!empty($value[4]) && !in_array($value[4],['Stucco','Wood'])){{'checked'}} @else{{old('option_nine_ans[4]')==langMessage('none')?'checked':''}}@endif value="{{langMessage('Other')}}" id="custom_checkbox_1"><input onfocusout="pastValue1(this.value)" type="text" name="" @if(!empty($value[4]) && !in_array($value[4],['Stucco','Wood']))  value="{{ $value[4] }}" @else value="{{ old('option_nine_ans[4]') }}" @endif placeholder="{{langMessage('Other')}}">
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('What are the wall on centers?')}}</label>
  <input type="hidden" name="option_nine_qes[5]" value="{{langMessage('What are the wall on centers?')}}">
  <input class="form-control" name="option_nine_ans[5]"   @if(!empty($value[5]))  value="{{ $value[5] }}" @else value="{{ old('option_nine_ans[5]') }}" @endif type="text" id="" placeholder="">
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('What type of framing is in the walls?')}}</label><br>
  <input type="hidden" name="option_nine_qes[6]" value="{{langMessage('What type of framing is in the walls?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[6]" @if(!empty($value[6])){{$value[6]==langMessage('2X4')?'checked':''}} @else{{old('option_nine_ans[6]')==langMessage('2X4')?'checked':''}}@endif value="{{langMessage('2X4')}}">{{langMessage('2X4')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[6]" @if(!empty($value[6])){{$value[6]==langMessage('2X6')?'checked':''}} @else{{old('option_nine_ans[6]')==langMessage('2X6')?'checked':''}}@endif value="{{langMessage('2X6')}}">{{langMessage('2X6')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[6]" @if(!empty($value[6])){{$value[6]==langMessage('2X8')?'checked':''}} @else{{old('option_nine_ans[6]')==langMessage('2X8')?'checked':''}}@endif value="{{langMessage('2X8')}}">{{langMessage('2X8')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[6]" @if(!empty($value[6])){{$value[6]==langMessage('2X10')?'checked':''}} @else{{old('option_nine_ans[6]')==langMessage('2X10')?'checked':''}}@endif value="{{langMessage('2X10')}}">{{langMessage('2X10')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_nine_ans[6]" @if(!empty($value[6]) && !in_array($value[6],['2X4','2X6','2X8','2X10'])){{'checked'}} @else{{old('option_nine_ans[6]')==langMessage('none')?'checked':''}}@endif value="{{langMessage('Other')}}" id="custom_checkbox_2"><input onfocusout="pastValue2(this.value)" type="text" name="" @if(!empty($value[6]) && !in_array($value[6],['2X4','2X6','2X8','2X10']))  value="{{ $value[6] }}" @else value="{{ old('option_nine_ans[6]') }}" @endif placeholder="{{langMessage('Other')}}">
  </label>
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script type="text/javascript">
  var pastValue1 = function(value){
    $("#custom_checkbox_1").val(value);
  }
  var pastValue2 = function(value){
    $("#custom_checkbox_2").val(value);
  }

  $("body .wall-insulation-install-type input[type=radio]").on('change', function(){
    var values = $(this).attr('data-value');
    if(values == "TAP Insulation" || values == "Fiberglass" || values == "Cellulose"){
      $(".option_nine_qes_3").show();
      $(".option_nine_qes_2").hide();
      $(".option_nine_qes_2 input").attr('disabled','disabled');
      $(".option_nine_qes_3 input").removeAttr('disabled');
    }
    else{
      $(".option_nine_qes_3").hide();
      $(".option_nine_qes_2").show();
      $(".option_nine_qes_3 input").attr('disabled','disabled');
      $(".option_nine_qes_2 input").removeAttr('disabled');
      $(".option_nine_qes_4").hide();
      $(".option_nine_qes_4 input").attr('disabled','disabled');
      $(".option_nine_qes_3 input:radio").removeAttr("checked");
    }
  });

  $("body .option_nine_qes_3 input[type=radio]").on('change', function(){
    var values = $(this).attr('data-value');
    if(values == "Through exterior"){
      $(".option_nine_qes_4").show();
      $(".option_nine_qes_4 input").removeAttr('disabled');
    }
    else{
      $(".option_nine_qes_4").hide();
      $(".option_nine_qes_4 input").attr('disabled','disabled');
    }
  });
</script>
