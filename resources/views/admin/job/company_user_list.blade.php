@if(!$companies->isEmpty())
  <option value="">{{'select'}}</option>
  @foreach($companies as $company)
    <option value="{{$company->id}}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{$company->company_name}}</option>
  @endforeach
@else
    <option value="">{{'no companies found'}}</option>
@endif
