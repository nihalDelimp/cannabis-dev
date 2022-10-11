
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
                <p class="puco-text"><em>Hi {{$body['name']}},</em><br><br><em>Have you heard the news? Something big is coming from {{$body['event_name']}}.</em><br><br><em>On {{ $body['event_time']}}, we’ll be launching our [Insert new product or service name] live at [Location].</em><br><br><em>Be the first to learn everything about [Insert new product or service], as well as receive exclusive access to [Benefit of attending].</em><br><br><em>Get on the list today!</em>
                    <br><br><em>
                        {{ $body['qr_code'] }} 
                    </em></p>
            </div>
        </div>
    </div>