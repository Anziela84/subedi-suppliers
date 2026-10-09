@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <!-- Hero -->
    <section class="contact-hero">
        <img class="contact-hero-photo" src="{{ asset('images/contactimage.webp') }}" alt="" aria-hidden="true" width="1983" height="793" fetchpriority="high">
        <div class="contact-hero-shade" aria-hidden="true"></div>
        <div class="max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="contact-hero-content">
                <span class="contact-hero-eyebrow"><span class="contact-hero-line" aria-hidden="true"></span>Contact</span>
                <h1 class="contact-hero-title">Visit us or say hello.</h1>
                <p class="contact-hero-text">Call, message us on WhatsApp, or drop by the shop.</p>
            </div>
        </div>
    </section>

    <!-- Quick actions -->
    <section class="contact-quick">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="contact-quick-grid" data-reveal-stagger>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phones')[0]) }}" class="contact-quick-card">
                    <span class="contact-quick-icon">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </span>
                    <span class="contact-quick-divider" aria-hidden="true"></span>
                    <span class="contact-quick-text">
                        <span class="contact-quick-title">Call us</span>
                        <span class="contact-quick-value">{{ config('site.phones')[0] }}</span>
                    </span>
                </a>

                @if(config('site.whatsapp'))
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="contact-quick-card whatsapp">
                        <span class="contact-quick-icon">
                            <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </span>
                        <span class="contact-quick-divider" aria-hidden="true"></span>
                        <span class="contact-quick-text">
                            <span class="contact-quick-title">WhatsApp</span>
                            <span class="contact-quick-value">Chat with us</span>
                            <span class="contact-quick-sub">Message us directly</span>
                        </span>
                    </a>
                @endif

                <a href="mailto:{{ config('site.emails')[0] }}" class="contact-quick-card">
                    <span class="contact-quick-icon">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <span class="contact-quick-divider" aria-hidden="true"></span>
                    <span class="contact-quick-text">
                        <span class="contact-quick-title">Email us</span>
                        <span class="contact-quick-value">{{ config('site.emails')[0] }}</span>
                        <span class="contact-quick-sub">Product questions and bulk enquiries</span>
                    </span>
                </a>

                <a href="{{ config('site.map_directions_url') }}" target="_blank" rel="noopener" class="contact-quick-card">
                    <span class="contact-quick-icon">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
                    </span>
                    <span class="contact-quick-divider" aria-hidden="true"></span>
                    <span class="contact-quick-text">
                        <span class="contact-quick-title">Visit us</span>
                        <span class="contact-quick-value">{{ config('site.address_lines')[0] }} · Get directions</span>
                        <span class="contact-quick-sub">Our store location</span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Main contact section -->
    <section id="contact-form" class="contact-main">
        <div class="contact-layout">
            <div data-reveal>
                <span class="contact-eyebrow">Send us a message</span>
                <h2 class="contact-heading">Write to us</h2>
                <p class="contact-lead">Prefer to talk? Use the buttons above.</p>

                @if(session('success'))
                    <div class="success-panel" role="status" aria-live="polite">
                        <svg class="success-icon" viewBox="0 0 52 52" aria-hidden="true">
                            <circle cx="26" cy="26" r="25" fill="none"/>
                            <path fill="none" stroke="currentColor" stroke-width="3" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                        <p class="success-text">Thank you! Your message has been sent.</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="contact-form" novalidate>
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="field">
                            <label for="name" class="field-label">Full Name *</label>
                            <div class="input-wrap">
                                <svg class="input-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="contact-input has-icon" placeholder="John Doe" autocomplete="name" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror />
                            </div>
                            @error('name')
                                <span class="field-error" id="name-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="email" class="field-label">Email Address *</label>
                            <div class="input-wrap">
                                <svg class="input-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="contact-input has-icon" placeholder="john@example.com" autocomplete="email" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror />
                            </div>
                            @error('email')
                                <span class="field-error" id="email-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="field">
                        <label for="subject" class="field-label">Subject *</label>
                        <select id="subject" name="subject" required class="contact-input" @error('subject') aria-invalid="true" aria-describedby="subject-error" @enderror>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a subject</option>
                            <option value="general" {{ old('subject') === 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="products" {{ old('subject') === 'products' ? 'selected' : '' }}>Product Question</option>
                            <option value="orders" {{ old('subject') === 'orders' ? 'selected' : '' }}>Order / Bulk Inquiry</option>
                            <option value="other" {{ old('subject') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('subject')
                            <span class="field-error" id="subject-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label for="message" class="field-label">Your Message *</label>
                        <div class="input-wrap is-textarea">
                            <svg class="input-icon" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            <textarea id="message" name="message" rows="5" required class="contact-input contact-textarea has-icon" placeholder="Tell us how we can help..." @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span class="field-error" id="message-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-primary submit-btn w-full font-medium transition inline-flex items-center justify-center gap-2">
                        <span class="submit-text">Send Message</span>
                        <svg class="submit-arrow w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        <svg class="submit-spinner hidden w-5 h-5 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-opacity="0.25" />
                            <path d="M12 2a10 10 0 0 1 10 10" stroke-opacity="1" />
                        </svg>
                    </button>
                    <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true" />
                </form>
            </div>

            <aside class="contact-aside" data-reveal>
                <div class="contact-location">
                    <div class="contact-location-row">
                        <span class="contact-location-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <div>
                            <h3>Opening hours</h3>
                            <span class="open-badge {{ $isOpen ? 'is-open' : 'is-closed' }}">{{ $statusText }}</span>
                            <p>{{ config('site.business_hours') }}</p>
                        </div>
                    </div>
                    <div class="contact-location-row">
                        <span class="contact-location-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
                        </span>
                        <div>
                            <h3>Find us</h3>
                            <p>{{ implode(', ', config('site.address_lines')) }}</p>
                            <a class="directions-link" href="{{ config('site.map_directions_url') }}" target="_blank" rel="noopener">Get directions &rarr;</a>
                        </div>
                    </div>
                    @if(config('site.map_embed_url'))
                        <div class="contact-location-map">
                            <iframe
                                src="{{ config('site.map_embed_url') }}"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                                title="Map showing the SubediSuppliers store location"
                            ></iframe>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('.contact-form');
    if (!form) return;
    var firstInvalid = form.querySelector('[aria-invalid="true"]');
    if (firstInvalid) {
        firstInvalid.focus({ preventScroll: false });
    }
});
</script>
@endpush
