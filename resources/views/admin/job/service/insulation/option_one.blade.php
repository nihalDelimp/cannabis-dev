<div class="" id="option_one">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Attic insulation removal & sanitize')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('How thick is the existing insulation?')}}</label><br>
  <input type="hidden" name="option_one_qes[1]" value="{{langMessage('How thick is the existing insulation?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[1]" @if(!empty($value[1]))  {{ $value[1] == langMessage('0-3 Inches') ? 'checked' : '' }} @else {{ old('option_one_ans[1]') == langMessage('0-3 Inches') ? 'checked' : '' }} @endif value="{{langMessage('0-3 Inches')}}">{{langMessage('0-3 Inches')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[1]"  @if(!empty($value[1]))  {{ $value[1] == langMessage('4-8 Inches') ? 'checked' : '' }} @else {{ old('option_one_ans[1]') == langMessage('4-8 Inches') ? 'checked' : '' }} @endif value="{{langMessage('4-8 Inches')}}">{{langMessage('4-8 Inches')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[1]"  @if(!empty($value[1]))  {{ $value[1] == langMessage('9-12 Inches') ? 'checked' : '' }} @else {{ old('option_one_ans[1]') == langMessage('9-12 Inches') ? 'checked' : '' }} @endif value="{{langMessage('9-12 Inches')}}">{{langMessage('9-12 Inches')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[1]"  @if(!empty($value[1]))  {{ $value[1] == langMessage('13 Plus Inches') ? 'checked' : '' }} @else {{ old('option_one_ans[1]') == langMessage('13 Plus Inches') ? 'checked' : '' }} @endif value="{{langMessage('13 Plus Inches')}}">{{langMessage('13 Plus Inches')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('What type of existing insulation?')}}</label><br>
  <input type="hidden" name="option_one_qes[2]" value="{{langMessage('What type of existing insulation?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[2]"  @if(!empty($value[2])){{$value[2]==langMessage('Batts')?'checked':''}} @else{{old('option_one_ans[2]')==langMessage('Batts')?'checked':''}}@endif value="{{langMessage('Batts')}}">{{langMessage('Batts')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[2]"  @if(!empty($value[2])){{$value[2]==langMessage('Blown')?'checked':''}} @else{{old('option_one_ans[2]')==langMessage('Blown')?'checked':''}}@endif value="{{langMessage('Blown')}}">{{langMessage('Blown')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[2]"  @if(!empty($value[2])){{$value[2]==langMessage('Both')?'checked':''}} @else{{old('option_one_ans[2]')==langMessage('Both')?'checked':''}}@endif value="{{langMessage('Both')}}">{{langMessage('Both')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="cell_number">{{langMessage('Debris Present?')}}</label><br>
  <input type="hidden" name="option_one_qes[3]" value="{{langMessage('Debris Present?')}}">
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[3]" @if(!empty($value[3])){{$value[3]==langMessage('Yes')?'checked':''}} @else{{old('option_one_ans[3]')==langMessage('Yes')?'checked':''}}@endif value="{{langMessage('Yes')}}">{{langMessage('Yes')}}
  </label>
  <label class="radio-inline">
  <input type="radio" required name="option_one_ans[3]" @if(!empty($value[3])){{$value[3]==langMessage('No')?'checked':''}} @else{{old('option_one_ans[3]')==langMessage('No')?'checked':''}}@endif value="{{langMessage('No')}}">{{langMessage('No')}}
  </label>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Attic square footage to be removed')}}</label>
  <input type="hidden" name="option_one_qes[4]" value="{{langMessage('Attic square footage to be removed')}}">
  <input class="form-control" name="option_one_ans[4]"   @if(!empty($value[4]))  value="{{ $value[4] }}" @else value="{{ old('option_one_ans[4]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
