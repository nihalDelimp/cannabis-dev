
<h2>Hello {{$body['name']}},</h2>
{{-- <h2>Production Link:  {{$body['production_link']}},</h2> --}}
<h2> Email:  {{$body['email']}},</h2>
<p>QR Code {{ $body['qr_code'] }}</p>
    {{-- @component('mail::button', ['url' => $body['production_link']]) @endcomponent  --}}