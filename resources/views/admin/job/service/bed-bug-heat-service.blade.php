<div class="form-group col-sm-12">
  <h4 class="box-title">{{langMessage('Scope of Work:')}}</h4>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Steam:')}}</label><br>
<input type="hidden" name="qes[1]" value="{{langMessage('Steam:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[1]" @if(!empty($value)){{$value[1]==langMessage('Yes')?'checked':''}} @else{{old('ans[1]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[1]" @if(!empty($value)){{$value[1]==langMessage('No')?'checked':''}} @else{{old('ans[1]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('How many vehicles?:')}}</label>
<input type="hidden" name="qes[2]" value="{{langMessage('How many vehicles?:')}}">
<input class="form-control" name="ans[2]" @if(!empty($value))value="{{$value[2]}}" @else value="{{old('ans[2]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Any additional areas?:')}}</label>
<input type="hidden" name="qes[3]" value="{{langMessage('Any additional areas?:')}}">
<input class="form-control" name="ans[3]" @if(!empty($value))value="{{$value[3]}}" @else value="{{old('ans[3]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('How many units?:')}}</label>
<input type="hidden" name="qes[4]" value="{{langMessage('How many units?')}}">
<input class="form-control" name="ans[4]" @if(!empty($value))value="{{$value[4]}}" @else value="{{old('ans[4]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Unit #\'s To Be Serviced:')}}</label>
<input type="hidden" name="qes[5]" value="{{langMessage('Unit #\'s To Be Serviced:')}}">
<input class="form-control" name="ans[5]" @if(!empty($value))value="{{$value[5]}}" @else value="{{old('ans[5]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('If there are multiple units, are they next to each other?')}}</label>
<br>
<input type="hidden" name="qes[6]" value="{{langMessage('If there are multiple units, are they next to each other?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[6]" @if(!empty($value)){{$value[6]==langMessage('Yes')?'checked':''}} @else{{old('ans[6]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required  name="ans[6]" @if(!empty($value)){{$value[6]==langMessage('No')?'checked':''}} @else{{old('ans[6]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('What floor are the units on?')}}</label>
<input type="hidden" name="qes[7]" value="{{langMessage('What floor are the units on?')}}">
<input class="form-control" name="ans[7]" @if(!empty($value))value="{{$value[7]}}" @else value="{{old('ans[7]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Do the windows open on each floor where service is to be provided?')}}</label>
<br>
<input type="hidden" name="qes[8]" value="{{langMessage('Do the windows open on each floor where service is to be provided?')}}">
<label class="radio-inline">
<input type="radio" required  name="ans[8]" @if(!empty($value)){{$value[8]==langMessage('Yes')?'checked':''}} @else{{old('ans[8]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[8]" @if(!empty($value)){{$value[8]==langMessage('No')?'checked':''}} @else{{old('ans[8]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Sprinkler System?')}}</label>
<br>
<input type="hidden" name="qes[9]" value="{{langMessage('Sprinkler System?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[9]" @if(!empty($value)){{$value[9]==langMessage('Yes')?'checked':''}} @else{{old('ans[9]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[9]" @if(!empty($value)){{$value[9]==langMessage('No')?'checked':''}} @else{{old('ans[9]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Level of infestation:')}}</label>
<br>
<input type="hidden" name="qes[10]" value="{{langMessage('Level of infestation:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[10]" @if(!empty($value)){{$value[10]==langMessage('Heavy')?'checked':''}} @else{{old('ans[10]')==langMessage('Heavy')?'checked':''}}@endif value="{{langMessage('Heavy')}}">{{langMessage('Heavy')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[10]" @if(!empty($value)){{$value[10]==langMessage('Light')?'checked':''}} @else{{old('ans[10]')==langMessage('Light')?'checked':''}}@endif value="{{langMessage('Light')}}">{{langMessage('Light')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Level of clutter:')}}</label>
<br>
<input type="hidden" name="qes[11]" value="{{langMessage('Level of clutter:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[11]" @if(!empty($value)){{$value[11]==langMessage('Heavy')?'checked':''}} @else{{old('ans[11]')==langMessage('Heavy')?'checked':''}}@endif value="{{langMessage('Heavy')}}">{{langMessage('Heavy')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[11]" @if(!empty($value)){{$value[11]==langMessage('Medium')?'checked':''}} @else{{old('ans[11]')==langMessage('Medium')?'checked':''}}@endif value="{{langMessage('Medium')}}">{{langMessage('Medium')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[11]" @if(!empty($value)){{$value[11]==langMessage('Light')?'checked':''}} @else{{old('ans[11]')==langMessage('Light')?'checked':''}}@endif value="{{langMessage('Light')}}">{{langMessage('Light')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('# of Bedrooms:')}}</label>
<input type="hidden" name="qes[12]" value="{{langMessage('# of Bedrooms:')}}">
<input class="form-control" name="ans[12]" @if(!empty($value))value="{{$value[12]}}" @else value="{{old('ans[12]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('# Living Areas:')}}</label>
<input type="hidden" name="qes[13]" value="{{langMessage('# Living Areas:')}}">
<input class="form-control" name="ans[13]" @if(!empty($value))value="{{$value[13]}}" @else value="{{old('ans[13]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Square Feet (if a home):')}}</label>
<input type="hidden" name="qes[14]" value="{{langMessage('Square Feet (if a home):')}}">
<input class="form-control" name="ans[14]" @if(!empty($value))value="{{$value[14]}}" @else value="{{old('ans[14]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Is parking available close to the units to be serviced?')}}</label>
<br>
<input type="hidden" name="qes[15]" value="{{langMessage('Is parking available close to the units to be serviced?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[15]" @if(!empty($value)){{$value[15]==langMessage('Yes')?'checked':''}} @else{{old('ans[15]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[15]" @if(!empty($value)){{$value[15]==langMessage('No')?'checked':''}} @else{{old('ans[15]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Are there any locked gates or access codes needed?')}}</label>
<br>
<input type="hidden" name="qes[16]" value="{{langMessage('Are there any locked gates or access codes needed?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[16]" @if(!empty($value)){{$value[16]==langMessage('Yes')?'checked':''}} @else{{old('ans[16]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[16]" @if(!empty($value)){{$value[16]==langMessage('No')?'checked':''}} @else{{old('ans[16]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Access code:')}}</label>
<input type="hidden" name="qes[17]" value="{{langMessage('Access code:')}}">
<input class="form-control" name="ans[17]" @if(!empty($value))value="{{$value[17]}}" @else value="{{old('ans[17]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Keys can be picked up')}}</label>
<br>
<input type="hidden" name="qes[18]" value="{{langMessage('Keys can be picked up')}}">
<label class="radio-inline">
<input type="radio" required name="ans[18]" @if(!empty($value)){{$value[18]==langMessage('From Onsite Manager')?'checked':''}} @else{{old('ans[18]')==langMessage('From Onsite Manager')?'checked':''}}@endif value="{{langMessage('From Onsite Manager')}}">{{langMessage('From Onsite Manager')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[18]" @if(!empty($value)){{$value[18]==langMessage('Direct from tenant')?'checked':''}} @else{{old('ans[18]')==langMessage('Direct from tenant')?'checked':''}}@endif value="{{langMessage('Direct from tenant')}}">{{langMessage('Direct from tenant')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Or, Pick up keys from:')}}</label>
<input type="hidden" name="qes[19]" value="{{langMessage('Or, Pick up keys from:')}}">
<input class="form-control" name="ans[19]" @if(!empty($value))value="{{$value[19]}}" @else value="{{old('ans[19]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Are there any pets or exotic animals?')}}
  <br><strong>(Please make sure all pets/exotic animals are removed from service site)</strong> </label>
<br>
<input type="hidden" name="qes[20]" value="{{langMessage('Are there any pets or exotic animals?')}}">
<label class="radio-inline">
<input type="radio" required name="ans[20]" @if(!empty($value)){{$value[20]==langMessage('Yes')?'checked':''}} @else{{old('ans[20]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[20]" @if(!empty($value)){{$value[20]==langMessage('No')?'checked':''}} @else{{old('ans[20]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Signed prep sheet will be:')}}</label>
<br>
<input type="hidden" name="qes[21]" value="{{langMessage('Signed prep sheet will be:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[21]" @if(!empty($value)){{$value[21]==langMessage('sent by PCO')?'checked':''}} @else{{old('ans[21]')==langMessage('sent by PCO')?'checked':''}}@endif value="{{langMessage('sent by PCO')}}">{{langMessage('sent by PCO')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[21]" @if(!empty($value)){{$value[21]==langMessage('picked up on day of service with manager/tenant/owner')?'checked':''}} @else{{old('ans[21]')==langMessage('picked up on day of service with manager/tenant/owner')?'checked':''}}@endif value="{{langMessage('picked up on day of service with manager/tenant/owner')}}">{{langMessage('picked up on day of service with manager/tenant/owner')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Price:')}}</label>
<input type="hidden" name="qes[22]" value="{{langMessage('Price:')}}">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
<input class="form-control" name="ans[22]" @if(!empty($value))value="{{$value[22]}}" @else value="{{old('ans[22]')}}" @endif type="text"  id="job_price" placeholder="">
</div>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Special Instructions:')}}</label>
<input type="hidden" name="qes[23]" value="{{langMessage('Special Instructions:')}}">
<textarea class="form-control textarea" name="ans[23]" rows="8" cols="80" id="">@if(!empty($value)) {{$value[23]}} @else {{old('ans[23]')}} @endif</textarea>
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
</script>
