<div class="" id="option_ten">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Subfloor vacuum & disinfect')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Subfloor square footage to be vacuumed')}}</label>
  <input type="hidden" name="option_ten_qes[1]" value="{{langMessage('Subfloor square footage to be vacuumed')}}">
  <input class="form-control" name="option_ten_ans[1]"   @if(!empty($value[1]))  value="{{ $value[1] }}" @else value="{{ old('option_ten_ans[1]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
