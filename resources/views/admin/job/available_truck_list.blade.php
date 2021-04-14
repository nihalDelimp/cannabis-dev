@if(!$trucks->isEmpty())
  <option value="">{{'select'}}</option>
  @foreach($trucks as $truck)
    <option value="{{$truck->id}}" {{ $job->truck_id == $truck->id ? 'selected' : '' }}>{{$truck->title.' ('.$truck->truck_number.')'}}</option>
  @endforeach
@else
  <option value="">{{'no trucks found'}}</option>
@endif
