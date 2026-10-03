@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <!-- Contact Hero -->
    <section class="contact-hero">
        <div class="contact-hero-bg">
            <img src="{{ asset('images/contactimage.png') }}" alt="Traditional metalware" class="contact-hero-img" />
        </div>
        <div class="contact-hero-overlay"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="contact-hero-content">
                    <span class="eyebrow contact-hero-eyebrow" style="color: rgba(250,248,243,0.82);">GET IN TOUCH</span>
                    <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold leading-tight" style="color: var(--color-cream, #FAF8F3);">
                        We're Here<br>to Help
                    </h1>
                    <p class="mt-4 text-lg md:text-xl contact-hero-desc" style="color: rgba(250, 248, 243, 0.85);">
                        Have a question about our products, need assistance, or want to visit our store? Our team is ready to support you.
                    </p>
                    <div class="mt-6 contact-hero-accent" aria-hidden="true"></div>
                </div>
                <div class="hidden lg:block"></div>
            </div>
        </div>
    </section>

    <!-- Three Column Contact Section -->
    <section id="contact-form" class="contact-main">
        <div class="contact-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12" data-reveal-stagger>
                <!-- Column 1: Contact Information -->
                <div class="lg:col-span-3 contact-col" data-reveal>
                    <div class="contact-info-group">
                        <div class="contact-info-item">
                            <div class="contact-icon-circle">
                                <svg class="w-5 h-5" style="color: var(--color-brand-blue, #0047AB);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <span class="contact-info-label">Phone</span>
                                @foreach(config('site.phones') as $phone)
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="contact-info-value" style="color: var(--color-ink, #1E252B);">{{ $phone }}</a>
                                @endforeach
                                <span class="contact-hours">{{ config('site.business_hours') }}</span>
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon-circle">
                                <svg class="w-5 h-5" style="color: var(--color-brand-blue, #0047AB);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="contact-info-label">Email</span>
                                @foreach(config('site.emails') as $email)
                                    <a href="mailto:{{ $email }}" class="contact-info-value" style="color: var(--color-ink, #1E252B);">{{ $email }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-icon-circle">
                                <svg class="w-5 h-5" style="color: var(--color-brand-blue, #0047AB);" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
                            </div>
                            <div>
                                <span class="contact-info-label">Our Location</span>
                                @foreach(config('site.address_lines') as $line)
                                    <span class="contact-info-value" style="color: var(--color-ink, #1E252B);">{{ $line }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="contact-socials">
                        @if(!empty(config('site.socials.facebook')))
                            <a href="{{ config('site.socials.facebook') }}" aria-label="Facebook" class="contact-social-link" target="_blank" rel="noopener">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                        @endif
                        @if(!empty(config('site.socials.instagram')))
                            <a href="{{ config('site.socials.instagram') }}" aria-label="Instagram" class="contact-social-link" target="_blank" rel="noopener">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                        @endif
                        @if(!empty(config('site.socials.youtube')))
                            <a href="{{ config('site.socials.youtube') }}" aria-label="YouTube" class="contact-social-link" target="_blank" rel="noopener">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.34-.44 2.68-1.24 3.81-1.13 1.56-2.99 2.66-5.12 2.66-2.36 0-4.3-1.65-4.73-3.88-.16-.82-.19-1.65-.02-2.47.37-1.8 1.74-3.17 3.54-3.47.81-.14 1.63-.06 2.4.24.02 1.15.01 2.3.01 3.45 0-.72-.01-1.43-.01-2.15-.64-.01-1.29-.02-1.93.01-.53.02-1.05.19-1.49.5-.89.64-1.41 1.74-1.41 2.85 0 .89.25 1.76.7 2.53.3.5.72.93 1.22 1.23.56.34 1.21.51 1.86.43 1.74-.21 3.01-1.72 3.07-3.46.02-1.21-.02-2.42.02-3.63.01-.65.19-1.3.52-1.88.36-.64.9-1.17 1.55-1.51.74-.38 1.59-.53 2.43-.4.01-1.54.01-3.08.01-4.62z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Column 2: Contact Form -->
                <div class="lg:col-span-5 contact-col" data-reveal>
                    <span class="eyebrow">SEND US A MESSAGE</span>
                    <h2 class="font-heading text-2xl font-bold mb-6" style="color: var(--color-ink, #1E252B);">Fill Out the Form</h2>

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
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="contact-input" placeholder="John Doe" autocomplete="name" />
                                @error('name')
                                    <span class="field-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field">
                                <label for="email" class="field-label">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="contact-input" placeholder="john@example.com" autocomplete="email" />
                                @error('email')
                                    <span class="field-error" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label for="subject" class="field-label">Subject *</label>
                            <select id="subject" name="subject" required class="contact-input">
                                <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Select a subject</option>
                                <option value="general" {{ old('subject') === 'general' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="products" {{ old('subject') === 'products' ? 'selected' : '' }}>Product Question</option>
                                <option value="orders" {{ old('subject') === 'orders' ? 'selected' : '' }}>Order / Bulk Inquiry</option>
                                <option value="other" {{ old('subject') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject')
                                <span class="field-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label for="message" class="field-label">Your Message *</label>
                            <textarea id="message" name="message" rows="5" required class="contact-input contact-textarea" placeholder="Tell us how we can help...">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="field-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn-primary submit-btn w-full px-6 py-3 rounded font-medium transition inline-flex items-center justify-center gap-2">
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

                <!-- Column 3: Visit Our Store -->
                <div class="lg:col-span-4 contact-col" data-reveal>
                    <div class="showroom-card">
                        @if(file_exists(public_path('images/showroom.jpg')))
                            <img src="{{ asset('images/showroom.jpg') }}" alt="Our showroom" class="showroom-img" />
                        @else
                            <div class="showroom-fallback">
                                <svg class="showroom-store-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9-7 9 7v11a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V10z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9"/>
                                </svg>
                                <span class="showroom-fallback-text">Showroom photo coming soon</span>
                            </div>
                        @endif
                        <div class="showroom-overlay">
                            <span class="eyebrow" style="color: var(--color-blue-tint, #EEF3F9);">VISIT US</span>
                            <h3 class="font-heading text-xl font-bold" style="color: var(--color-cream, #FAF8F3);">Our Showroom</h3>
                            <a href="{{ config('site.map_directions_url') }}" target="_blank" rel="noopener" class="showroom-link">
                                Get Directions
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section" data-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(config('site.map_embed_url'))
                <div class="map-embed">
                    <iframe
                        src="{{ config('site.map_embed_url') }}"
                        width="100%"
                        height="100%"
                        style="border:0; display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Store location map">
                    </iframe>
                </div>
            @else
                <div class="map-bar">
                    <span>Map coming soon</span>
                    <a href="{{ config('site.map_directions_url') }}" target="_blank" rel="noopener" class="btn-primary-outline inline-flex items-center px-5 py-2.5 rounded font-medium transition">
                        Get Directions
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
