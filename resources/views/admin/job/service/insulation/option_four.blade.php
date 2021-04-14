<div class="" id="option_four">
  <div class="form-group col-sm-12">
    <h4 class="box-title">{{langMessage('Attic radiant barrier')}}</h4>
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('What are the attic on centers?:')}}</label>
  <input type="hidden" name="option_four_qes[1]" value="{{langMessage('What are the attic on centers(radiant barrier)?')}}">
  <input class="form-control" name="option_four_ans[1]"   @if(!empty($value[1]))  value="{{ $value[1] }}" @else value="{{ old('option_four_ans[1]') }}" @endif type="text" id="" placeholder="">
  </div>
  <div class="col-sm-6 col-sm-offset-3 form-group">
  <label for="">{{langMessage('Attic square footage to be installed (add 20% to the attic sqft)')}}</label>
  <input type="hidden" name="option_four_qes[2]" value="{{langMessage('Attic square footage to be installed (add 20% to the attic sqft)')}}">
  <input class="form-control" name="option_four_ans[2]"   @if(!empty($value[2]))  value="{{ $value[2] }}" @else value="{{ old('option_four_ans[2]') }}" @endif type="text" id="" placeholder="">
  </div>
</div>
