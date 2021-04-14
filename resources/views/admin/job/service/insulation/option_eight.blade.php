<div class="" id="option_eight">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Attic kneewall install')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Attic kneewall square footage to be installed')}}</label>
  <input type="hidden" name="option_eight_qes[1]" value="{{langMessage('Attic kneewall square footage to be installed')}}">
  <input class="form-control" name="option_eight_ans[1]"   @if(!empty($value[1]))  value="{{ $value[1] }}" @else value="{{ old('option_eight_ans[1]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
