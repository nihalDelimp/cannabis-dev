<div class="form-group col-sm-12">
  <h4 class="box-title">{{langMessage('Scope of Work:')}}</h4>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('What type of pest is this proofing for?')}}</label><br>
<input type="hidden" name="qes[1]" value="{{langMessage('What type of pest is this proofing for?')}}">
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][0]" @if(!empty($value[1][0])){{$value[1][0]==langMessage('Rats')?'checked':''}} @else{{old('ans[1][0]')==langMessage('Rats')?'checked':''}}@endif value="{{langMessage('Rats')}}">{{langMessage('Rats')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][1]" @if(!empty($value[1][1])){{$value[1][1]==langMessage('Mice')?'checked':''}} @else{{old('ans[1][1]')==langMessage('Mice')?'checked':''}}@endif value="{{langMessage('Mice')}}">{{langMessage('Mice')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][2]" @if(!empty($value[1][2])){{'checked'}} @else{{old('ans[1][2]')==langMessage('none')?'checked':''}}@endif value="{{langMessage('Other')}}" id="custom_checkbox_1"><input onfocusout="pastValue1(this.value)" type="text" name="" @if(!empty($value[1][2]))  value="{{ $value[1][2] }}" @else value="{{ old('ans[1][2]') }}" @endif placeholder="{{langMessage('Other')}}">
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Entry Points:')}}</label><br>
<input type="hidden" name="qes[2]" value="{{langMessage('Entry Points')}}">
<label class="radio-inline">
<input type="radio" required name="ans[2]" @if(!empty($value))  {{ $value[2] == langMessage('0-20') ? 'checked' : '' }} @else {{ old('ans[2]') == langMessage('0-20') ? 'checked' : '' }} @endif  value="{{langMessage('0-20')}}">{{langMessage('0-20')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[2]" @if(!empty($value))  {{ $value[2] == langMessage('21-30') ? 'checked' : '' }} @else {{ old('ans[2]') == langMessage('21-30') ? 'checked' : '' }} @endif value="{{langMessage('21-30')}}">{{langMessage('21-30')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[2]" @if(!empty($value))  {{ $value[2] == langMessage('31-40') ? 'checked' : '' }} @else {{ old('ans[2]') == langMessage('31-40') ? 'checked' : '' }} @endif value="{{langMessage('31-40')}}">{{langMessage('31-40')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[2]" @if(!empty($value))  {{ $value[2] == langMessage('41+') ? 'checked' : '' }} @else {{ old('ans[2]') == langMessage('41+') ? 'checked' : '' }} @endif value="{{langMessage('41+')}}">{{langMessage('41+')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('# of Exterior Door Sweeps:')}}</label>
<input type="hidden" name="qes[3]" value="{{langMessage('# of Exterior Door Sweeps')}}">
<input class="form-control" name="ans[3]"  @if(!empty($value))  value="{{ $value[3] }}" @else value="{{ old('ans[3]') }}" @endif  type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Xcluder Garage Door Seal:')}}</label><br>
<input type="hidden" name="qes[4]" value="{{langMessage('Xcluder Garage Door Seal')}}">
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value))  {{ $value[4] == langMessage('Single') ? 'checked' : '' }} @else {{ old('ans[4]') == langMessage('Single') ? 'checked' : '' }} @endif value="{{langMessage('Single')}}">{{langMessage('Single')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value))  {{ $value[4] == langMessage('Double') ? 'checked' : '' }} @else {{ old('ans[4]') == langMessage('Double') ? 'checked' : '' }} @endif value="{{langMessage('Double')}}">{{langMessage('Double')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value))  {{ $value[4] == langMessage('None') ? 'checked' : '' }} @else {{ old('ans[4]') == langMessage('None') ? 'checked' : '' }} @endif value="{{langMessage('None')}}">{{langMessage('None')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Basic Garage Door Seal:')}}</label><br>
<input type="hidden" name="qes[5]" value="{{langMessage('Basic Garage Door Seal')}}">
<label class="radio-inline">
<input type="radio" required name="ans[5]" @if(!empty($value))  {{ $value[5] == langMessage('Single') ? 'checked' : '' }} @else {{ old('ans[5]') == langMessage('Single') ? 'checked' : '' }} @endif value="{{langMessage('Single')}}">{{langMessage('Single')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[5]" @if(!empty($value))  {{ $value[5] == langMessage('Double') ? 'checked' : '' }} @else {{ old('ans[5]') == langMessage('Double') ? 'checked' : '' }} @endif value="{{langMessage('Double')}}">{{langMessage('Double')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[5]" @if(!empty($value))  {{ $value[5] == langMessage('None') ? 'checked' : '' }} @else {{ old('ans[5]') == langMessage('None') ? 'checked' : '' }} @endif value="{{langMessage('None')}}">{{langMessage('None')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('How many sub floor access doors need to be rebuilt?:')}}</label>
<input type="hidden" name="qes[6]" value="{{langMessage('How many sub floor access doors need to be rebuilt?')}}">
<input class="form-control" name="ans[6]"  @if(!empty($value))  value="{{ $value[6] }}" @else value="{{ old('ans[6]') }}" @endif  type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Price:')}}</label>
<input type="hidden" name="qes[7]" value="{{langMessage('Price:')}}">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
<input class="form-control" name="ans[7]" @if(!empty($value))value="{{$value[7]}}" @else value="{{old('ans[7]')}}" @endif type="text" id="job_price" placeholder="">
</div>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Special Notes:')}}</label>
<input type="hidden" name="qes[8]" value="{{langMessage('Special Notes:')}}">
<textarea class="form-control textarea" name="ans[8]" rows="8" cols="80" id="">  @if(!empty($value)) {{ $value[8] }} @else {{ old('ans[8]') }} @endif</textarea>
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
  var pastValue1 = function(value){
    $("#custom_checkbox_1").val(value);
  }
</script>
