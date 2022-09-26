{{-- @component('mail::message')
<h2>Hello {{$body['name']}},</h2>
<p>The email is a sample email.
@endcomponent</p>
 
<p>Visit @component('mail::button', ['url' => $body['url']])
For create new password
@endcomponent </p>
 
 
Happy coding!<br>
 
Thanks,<br>
{{ config('app.name') }}<br>
Laravel Team.
@endcomponent --}}
<h2>Hello {{$body['name']}},</h2>
<h2>url:  {{$body['url']}},</h2>
<p>Visit @component('mail::button', ['url' => $body['url']])
    For create new password
    @endcomponent </p>