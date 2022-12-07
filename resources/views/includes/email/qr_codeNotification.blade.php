
{{-- <h2>Hello {{$body['name']}},</h2>
{{-- <h2>Production Link:  {{$body['production_link']}},</h2> --/}}
<h2> Email:  {{$body['email']}},</h2>
<p>QR Code {{ $body['qr_code'] }}</p> --}}
    {{-- @component('mail::button', ['url' => $body['production_link']]) @endcomponent  --}}
    <div class="puco-note puco-note--blue">
        <div class="puco-note__content">
            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#0070D6" class="puco-icon puco-icon-xs puco-note__content__icon">
                <path d="M5.867 6.75l5.28 4.928a1.25 1.25 0 001.706 0l5.28-4.928H5.867zM19.25 7.76l-5.374 5.015a2.75 2.75 0 01-3.752 0L4.75 7.759V17c0 .138.112.25.25.25h14a.25.25 0 00.25-.25V7.76zM3.25 7c0-.966.784-1.75 1.75-1.75h14c.966 0 1.75.784 1.75 1.75v10A1.75 1.75 0 0119 18.75H5A1.75 1.75 0 013.25 17V7z"></path>
            </svg>
            <div class="puco-text text_textBlock__WUY_8">
                <p class="puco-text"><em>Hi {{$body['name']}},</em><br><br>
                    <em>
                        This email contains the QR code you will need to access the live studio production. Please provide this QR code when you arrive as well as a proper ID. 
                        {{-- Have you heard the news? Something big is coming from {{$body['event_name']}}. --}}
                        <br><br>
                        Thank you for your participation in our live studio audience production and we can't wait for you to join us. This is a VIP and networking opportunity as well through RSVP invite only!
                    </em><br><br>
                    {{-- <em>On {{ $body['event_time']}}, we’ll be live casting  our production live at cannabis capitol prodcution room.</em><br><br><em>Be the part of it to learn everything about the {{$body['event_name']}}.
                    </em> --}}
                    <br><br>
                    
                    <em>
                        <div style="text-align: center;">
                        </div>
                       <img src="{{ $message->embedData(QrCode::format('png')->size(500)->generate($body['qr_code']), 'nameForAttachment.png') }}" />
                    {{-- </br>
                    {!! $body['qr_code'] !!}  --}}
                    </em><br><br>
                    <em>
                        Any information regarding this production can be accessed at CannabisCapitol.com under Productions.
                    </em>
                </p>
                    
                    
            </div>
        </div>
    </div>