<div class="form-group col-sm-12">
  <h4 class="box-title">{{langMessage('Scope of Work:')}}</h4>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('What type of termite heat is this?')}}</label><br>
<input type="hidden" name="qes[1]" value="{{langMessage('What type of termite heat is this?')}}">
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][0]" @if(!empty($value[1][0])){{$value[1][0]==langMessage('Attic only')?'checked':''}} @else{{old('ans[1]')==langMessage('Attic only')?'checked':''}}@endif value="{{langMessage('Attic only')}}">{{langMessage('Attic only')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][1]" @if(!empty($value[1][1])){{$value[1][1]==langMessage('Interior only')?'checked':''}} @else{{old('ans[1]')==langMessage('Interior only')?'checked':''}}@endif value="{{langMessage('Interior only')}}">{{langMessage('Interior only')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][2]" @if(!empty($value[1][2])){{$value[1][2]==langMessage('Local heat')?'checked':''}} @else{{old('ans[1]')==langMessage('Local heat')?'checked':''}}@endif value="{{langMessage('Local heat')}}">{{langMessage('Local heat')}}
</label>
<label class="checkbox-inline">
<input type="checkbox" name="ans[1][3]" @if(!empty($value[1][3])){{$value[1][3]==langMessage('Full structure')?'checked':''}} @else{{old('ans[1]')==langMessage('Full structure')?'checked':''}}@endif value="{{langMessage('Full structure')}}">{{langMessage('Full structure')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Cubes:')}}</label>
<input type="hidden" name="qes[2]" value="{{langMessage('Cubes:')}}">
<input class="form-control" name="ans[2]" @if(!empty($value))value="{{$value[2]}}" @else value="{{old('ans[2]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Attic Heat Only: (sq. ft.)')}}</label>
<input type="hidden" name="qes[3]" value="{{langMessage('Attic Heat Only: (sq. ft.)')}}">
<input class="form-control" name="ans[3]" @if(!empty($value)) value="{{$value[3]}}" @else value="{{old('ans[3]')}}" @endif type="text" id="" placeholder="">
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Is tarping required? (only needed if exterior wood needs to be heated)')}}</label><br>
<input type="hidden" name="qes[4]" value="{{langMessage('Is tarping required? (only needed if exterior wood needs to be heated)')}}">
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value)){{$value[4]==langMessage('Attic')?'checked':''}} @else{{old('ans[4]')==langMessage('Attic')?'checked':''}}@endif value="{{langMessage('Attic')}}">{{langMessage('Attic')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value)){{$value[4]==langMessage('Tarping')?'checked':''}} @else{{old('ans[4]')==langMessage('Tarping')?'checked':''}}@endif value="{{langMessage('Tarping')}}">{{langMessage('Tarping')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[4]" @if(!empty($value)){{$value[4]==langMessage('No Tarping')?'checked':''}} @else{{old('ans[4]')==langMessage('No Tarping')?'checked':''}}@endif value="{{langMessage('No Tarping')}}">{{langMessage('No Tarping')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Fire Sprinklers Present (must be drained):')}}</label><br>
<input type="hidden" name="qes[5]" value="{{langMessage('Fire Sprinklers Present (must be drained):')}}">
<label class="radio-inline">
<input type="radio" required name="ans[5]" @if(!empty($value)){{$value[5]==langMessage('Yes')?'checked':''}} @else{{old('ans[5]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[5]" @if(!empty($value)){{$value[5]==langMessage('No')?'checked':''}} @else{{old('ans[5]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Type of Structure:')}}</label><br>
<input type="hidden" name="qes[6]" value="{{langMessage('Type of Structure:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[6]" @if(!empty($value)){{$value[6]==langMessage('Apartment')?'checked':''}} @else{{old('ans[6]')==langMessage('Apartment')?'checked':''}}@endif value="{{langMessage('Apartment')}}">{{langMessage('Apartment')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[6]" @if(!empty($value)){{$value[6]==langMessage('Residential')?'checked':''}} @else{{old('ans[6]')==langMessage('Residential')?'checked':''}}@endif value="{{langMessage('Residential')}}">{{langMessage('Residential')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[6]" @if(!empty($value)){{$value[6]==langMessage('Commerical')?'checked':''}} @else{{old('ans[6]')==langMessage('Commerical')?'checked':''}}@endif value="{{langMessage('Commerical')}}">{{langMessage('Commerical')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="cell_number">{{langMessage('Stories:')}}</label><br>
<input type="hidden" name="qes[7]" value="{{langMessage('Stories:')}}">
<label class="radio-inline">
<input type="radio" required name="ans[7]" @if(!empty($value)){{$value[7]==langMessage('1 Story House')?'checked':''}} @else{{old('ans[7]')==langMessage('1 Story House')?'checked':''}}@endif value="{{langMessage('1 Story House')}}">{{langMessage('1 Story House')}}
</label>
<label class="radio-inline">
<input type="radio" required name="ans[7]" @if(!empty($value)){{$value[7]==langMessage('2 Story House')?'checked':''}} @else{{old('ans[7]')==langMessage('2 Story House')?'checked':''}}@endif value="{{langMessage('2 Story House')}}">{{langMessage('2 Story House')}}
</label>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<strong>{{langMessage('All termite heats MUST be accompanied by termite report to receive our warranty')}}</strong>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<strong>{{langMessage('*For Tarping - All tree branches/foliage must be cut back 2 feet')}}</strong>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Price:')}}</label>
<input type="hidden" name="qes[8]" value="{{langMessage('Price:')}}">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
<input class="form-control" name="ans[8]" @if(!empty($value))value="{{$value[8]}}" @else value="{{old('ans[8]')}}" @endif type="text" id="job_price" placeholder="">
</div>
</div>
<div class="col-sm-6 col-sm-offset-3 form-group">
<label for="">{{langMessage('Special Notes:')}}</label>
<input type="hidden" name="qes[9]" value="{{langMessage('Special Notes:')}}">
<textarea class="form-control textarea" name="ans[9]" rows="8" cols="80" id="">@if(!empty($value)) {{$value[9]}} @else {{old('ans[9]')}} @endif</textarea>
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
