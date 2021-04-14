<div class="form-group col-sm-6">
<label for="">{{langMessage('Is parking available close to the units to be serviced?')}}</label>
<br>
<label class="radio-inline">
<input type="radio" name="optradio" checked>{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" name="optradio">{{langMessage('No')}}
</label>
</div>
<div class="form-group col-sm-6">
<label for="">{{langMessage('Are there any locked gates or access codes needed?')}}</label>
<br>
<label class="radio-inline">
<input type="radio" name="optradio" checked>{{langMessage('Yes')}}
</label>
<label class="radio-inline">
<input type="radio" name="optradio">{{langMessage('No')}}
</label>
</div>
<div class="form-group col-sm-6">
<label for="">{{langMessage('Access code:')}}</label>
<input class="form-control" name="" value="{{ old('') }}" type="text" id="" placeholder="">
</div>
<div class="form-group col-sm-6">
<label for="">{{langMessage('Keys can be picked up')}}</label>
<br>
<label class="radio-inline">
<input type="radio" name="optradio" checked>{{langMessage('From Onsite Manager')}}
</label>
<label class="radio-inline">
<input type="radio" name="optradio">{{langMessage('Direct from tenant')}}
</label>
</div>
<div class="form-group col-sm-6">
<label for="">{{langMessage('Or, Pick up keys from:')}}</label>
<input class="form-control" name="" value="{{ old('') }}" type="text" id="" placeholder="">
</div>
