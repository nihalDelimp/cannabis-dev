<strong>{{ $data['service_name'] }}  booking for {{ getDateTime($data['booking_date'],'Y-m-d') }} @  "{{ $data['service_address'] }} {{ $data['city'] }} {{ $data['zip_code'] }} "  has been approved</strong>

<br>
<br>
<table border = "1">
<tr><td><strong>Company Representative:</strong></td><td>{{$data['sales_rep']}}</td></tr>
<tr><td><strong>Company Name:</strong></td><td>{{$data['company_name']}}</td></tr>
<tr><td><strong>Representative Phone:</strong></td><td>{{$data['sales_rep_phone']}}</td></tr>
<tr><td><strong>Email:</strong></td><td>{{$data['sales_rep_email']}}</td></tr>
@foreach($data['questions'] as $key=>$question)
  <tr><td><strong>{{$key}}:</strong></td><td>@if(is_array($question)){{implode(",",$question)}}@else{!!$question!!}@endif</td></tr>
@endforeach
@if(is_array($data['insulation_options']) && count($data['insulation_options'])>0)
  @foreach($data['insulation_options'] as $key=>$question)
    <tr><td><strong>{{$key}}:</strong></td><td>@if(is_array($question)){{implode(",",$question)}}@else{!!$question!!}@endif</td></tr>
  @endforeach
@endif
</table>
<br>
<strong>If you have any questions/concerns regarding this job, please give our office a call at 866-722-3372</strong>