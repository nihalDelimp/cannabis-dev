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
{{-- <h2>Production Link:  {{$body['production_link']}},</h2> --}}
<h2>Production Name:  {{$body['production_name']}},</h2>
<p>Please Visit  @component('mail::button', ['url' => $body['production_link']])
    link
    @endcomponent </p>