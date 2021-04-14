<div class="" id="option_five">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Subfloor insulation removal & sanitize')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Subfloor square footage to be removed')}}</label>
  <input type="hidden" name="option_five_qes[1]" value="{{langMessage('Subfloor square footage to be removed')}}">
  <input class="form-control" name="option_five_ans[1]"   @if(!empty($value[1]))  value="{{ $value[1] }}" @else value="{{ old('option_five_ans[1]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
