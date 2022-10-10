
<h2>Hello {{$body['name']}},</h2>
{{-- <h2>Production Link:  {{$body['production_link']}},</h2> --}}
<h2>Production Nmae:  {{$body['production_name']}},</h2>
<p>Please Visit @component('mail::button', ['url' => $body['production_link']]) @endcomponent </p>