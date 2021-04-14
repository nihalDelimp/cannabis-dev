<div class="" id="option_six">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Subfloor insulation install')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('What are the subfloor on centers?')}}</label>
  <input type="hidden" name="option_six_qes[1]" value="{{langMessage('What are the subfloor on centers?')}}">
  <input class="form-control" name="option_six_ans[1]"   @if(!empty($value[1]))  value="{{ $value[1] }}" @else value="{{ old('option_six_ans[1]') }}" @endif type="text" id="" placeholder="">
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('What type of framing is in the subfloor?')}}</label><br>
  <input type="hidden" name="option_six_qes[2]" value="{{langMessage('What type of framing is in the subfloor?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_six_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('2X4')?'checked':''}} @else{{old('option_six_ans[2]')==langMessage('2X4')?'checked':''}}@endif value="{{langMessage('2X4')}}">{{langMessage('2X4')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_six_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('2X6')?'checked':''}} @else{{old('option_six_ans[2]')==langMessage('2X6')?'checked':''}}@endif value="{{langMessage('2X6')}}">{{langMessage('2X6')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_six_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('2X8')?'checked':''}} @else{{old('option_six_ans[2]')==langMessage('2X8')?'checked':''}}@endif value="{{langMessage('2X8')}}">{{langMessage('2X8')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_six_ans[2]" @if(!empty($value[2])){{$value[2]==langMessage('2X10')?'checked':''}} @else{{old('option_six_ans[2]')==langMessage('2X10')?'checked':''}}@endif value="{{langMessage('2X10')}}">{{langMessage('2X10')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_six_ans[2]" @if(!empty($value[2]) && !in_array($value[2],['2X4','2X6','2X8','2X10'])){{'checked'}} @else{{old('option_six_ans[2]')==langMessage('none')?'checked':''}}@endif value="{{langMessage('Other')}}" id="custom_checkbox_1"><input onfocusout="pastValue1(this.value)" type="text" name="" @if(!empty($value[2]) && !in_array($value[2],['2X4','2X6','2X8','2X10']))  value="{{ $value[2] }}" @else value="{{ old('option_six_ans[2]') }}" @endif placeholder="{{langMessage('Other')}}">
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Subfloor square footage to be installed')}}</label>
  <input type="hidden" name="option_six_qes[3]" value="{{langMessage('Subfloor square footage to be installed')}}">
  <input class="form-control" name="option_six_ans[3]"   @if(!empty($value[3]))  value="{{ $value[3] }}" @else value="{{ old('option_six_ans[3]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
<script type="text/javascript">
  var pastValue1 = function(value){
    $("#custom_checkbox_1").val(value);
  }
</script>
