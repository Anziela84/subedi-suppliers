@props([
    'title' => '',
    'text' => '',
])

<section class="cta-band section-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="cta-band-title">{{ $title }}</h2>
        <p class="cta-band-text">{{ $text }}</p>
        <div class="cta-band-actions">
            @if(config('site.whatsapp'))
                <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="cta-band-btn whatsapp">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0 11.93 11.93 0 0 0 1.38 3.48 11.93 11.93 0 0 0 0 12a11.93 11.93 0 0 0 1.38 8.52A11.93 11.93 0 0 0 12 24a11.93 11.93 0 0 0 10.62-3.48A11.93 11.93 0 0 0 24 12a11.93 11.93 0 0 0 3.48-8.52zM12 22a10.12 10.12 0 0 1-5.16-1.42l-.36-.2-3.06.8.82-2.98-.24-.36A10.12 10.12 0 1 1 22 12a10.12 10.12 0 0 1-10 10zm5.88-7.5a7.86 7.86 0 0 1-4.2 1.2 4.14 4.14 0 0 1-1.98-.54l-1.08-.6-1.14.3a8.96 8.96 0 0 1-4.02-2.64 39.36 39.36 0 0 1-1.44-2.04 4.44 4.44 0 0 1-.24-1.5c0-.42.18-.78.54-1.02l.3-.3.54-.54a.45.45 0 0 1 .6 0l1.62 1.62a.45.45 0 0 1 0 .6l-.3.3a6.84 6.84 0 0 0-.36 3.12 6.84 6.84 0 0 0 9.72 0 6.84 6.84 0 0 0 0-9.72.45.45 0 0 1 0-.6l1.62-1.62a.45.45 0 0 1 .6 0l1.62 1.62a.45.45 0 0 1 0 .6 8.34 8.34 0 0 1-1.38 3.24z"/>
                    </svg>
                    WhatsApp us
                </a>
            @endif
            <a href="{{ route('contact') }}" class="cta-band-btn outline">Contact us</a>
        </div>
    </div>
</section>
