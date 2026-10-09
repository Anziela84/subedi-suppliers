<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'SubediSuppliers')</title>
    <meta name="description" content="@yield('meta_description', 'SubediSuppliers — Nepali metalware in copper, brass, kasa, steel and aluminium. Everyday essentials, traditional materials, chosen for the homes they become part of.')" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title', 'SubediSuppliers')" />
    <meta property="og:description" content="@yield('meta_description', 'SubediSuppliers — Nepali metalware in copper, brass, kasa, steel and aluminium. Everyday essentials, traditional materials, chosen for the homes they become part of.')" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@400;500;600;700&display=swap" crossorigin />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    @stack('head-styles')
    @stack('head-meta')
</head>
<body class="font-body text-gray-800 bg-white antialiased min-h-screen flex flex-col">

    <!-- Header / Nav -->
    <header class="site-header" id="siteHeader">
        <div class="site-header-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="site-logo" aria-label="SubediSuppliers home">
                <img src="{{ asset('images/logo.png') }}" alt="SubediSuppliers" class="site-logo-img" width="133" height="65">
            </a>

            <nav class="site-nav" id="siteNav" aria-label="Primary">
                <ul class="nav-links" id="navLinks">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
                    <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                    <li class="nav-cta-item"><a href="{{ route('contact') }}" class="nav-cta {{ request()->routeIs('contact') ? 'active' : '' }}">Enquire</a></li>
                </ul>
            </nav>

            <button class="navbar-toggle" id="navbarToggle" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="siteNav">
                <span></span><span></span><span></span>
            </button>
        </div>
    </header>

    <!-- Mobile nav overlay (outside header to escape backdrop-filter containing block) -->
    <nav class="site-nav-mobile" id="siteNavMobile" aria-label="Primary" hidden>
        <a href="{{ route('home') }}" class="site-nav-logo" aria-label="SubediSuppliers home">
            <img src="{{ asset('images/logo-footer-gold.png') }}" alt="SubediSuppliers" width="133" height="44">
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
            <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
            <li class="nav-cta-item"><a href="{{ route('contact') }}" class="nav-cta {{ request()->routeIs('contact') ? 'active' : '' }}">Enquire</a></li>
        </ul>
    </nav>

    <main class="grow">
        @yield('content')
    </main>
    <footer class="site-footer section-dark">
        <div class="site-footer-grain" aria-hidden="true"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
                <div>
                    <a href="{{ route('home') }}" class="site-footer-logo" aria-label="SubediSuppliers home">
                        <img src="{{ asset('images/logo-footer-gold.png') }}" alt="SubediSuppliers" width="377" height="166">
                    </a>
                    <p class="mt-2 text-sm" style="color: rgba(250, 248, 243, 0.75);">Copper, brass, kasa, steel and aluminium — objects made to last.</p>
                    @if(config('site.whatsapp'))
                        <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="btn-whatsapp mt-4 text-sm font-medium">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.52 3.48A11.93 11.93 0 0 0 12 0 11.93 11.93 0 0 0 1.38 3.48 11.93 11.93 0 0 0 0 12a11.93 11.93 0 0 0 1.38 8.52A11.93 11.93 0 0 0 12 24a11.93 11.93 0 0 0 10.62-3.48A11.93 11.93 0 0 0 24 12a11.93 11.93 0 0 0 3.48-8.52zM12 22a10.12 10.12 0 0 1-5.16-1.42l-.36-.2-3.06.8.82-2.98-.24-.36A10.12 10.12 0 1 1 22 12a10.12 10.12 0 0 1-10 10zm5.88-7.5a7.86 7.86 0 0 1-4.2 1.2 4.14 4.14 0 0 1-1.98-.54l-1.08-.6-1.14.3a8.96 8.96 0 0 1-4.02-2.64 39.36 39.36 0 0 1-1.44-2.04 4.44 4.44 0 0 1-.24-1.5c0-.42.18-.78.54-1.02l.3-.3.54-.54a.45.45 0 0 1 .6 0l1.62 1.62a.45.45 0 0 1 0 .6l-.3.3a6.84 6.84 0 0 0-.36 3.12 6.84 6.84 0 0 0 9.72 0 6.84 6.84 0 0 0 0-9.72.45.45 0 0 1 0-.6l1.62-1.62a.45.45 0 0 1 .6 0l1.62 1.62a.45.45 0 0 1 0 .6 8.34 8.34 0 0 1-1.38 3.24z"/></svg>
                            WhatsApp us
                        </a>
                    @endif
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color: var(--color-heritage, #9A7448);">Explore</p>
                    <nav class="flex flex-col gap-2 text-sm" style="color: rgba(250, 248, 243, 0.8);">
                        <a href="{{ route('home') }}" class="hover:text-[#C9A66B] transition">Home</a>
                        <a href="{{ route('products.index') }}" class="hover:text-[#C9A66B] transition">Products</a>
                        <a href="{{ route('categories.index') }}" class="hover:text-[#C9A66B] transition">Categories</a>
                        <a href="{{ route('about') }}" class="hover:text-[#C9A66B] transition">About</a>
                        <a href="{{ route('contact') }}" class="hover:text-[#C9A66B] transition">Contact</a>
                    </nav>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color: var(--color-heritage, #9A7448);">Visit &amp; contact</p>
                    <ul class="site-footer-links text-sm" style="color: rgba(250, 248, 243, 0.8);">
                        @if(config('site.address_lines'))
                            <li class="with-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><path d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/></svg>
                                <span>{{ implode(', ', config('site.address_lines')) }}</span>
                            </li>
                        @endif
                        @if(config('site.phones') && is_array(config('site.phones')) && count(config('site.phones')) > 0)
                            <li class="with-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phones')[0]) }}" style="color: inherit; text-decoration: none;">{{ config('site.phones')[0] }}</a>
                            </li>
                        @endif
                        @if(config('site.emails') && is_array(config('site.emails')) && count(config('site.emails')) > 0)
                            <li class="with-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <a href="mailto:{{ config('site.emails')[0] }}" style="color: inherit; text-decoration: none;">{{ config('site.emails')[0] }}</a>
                            </li>
                        @endif
                        @if(config('site.business_hours'))
                            <li class="with-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ config('site.business_hours') }}</span>
                            </li>
                        @endif
                    </ul>
                    @php
                        $socials = collect(config('site.socials'))
                            ->filter(fn ($url) => !empty($url) && $url !== '#')
                            ->all();
                    @endphp
                    @if(!empty($socials))
                        <div class="site-footer-socials">
                            @foreach($socials as $platform => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($platform) }}" class="site-footer-social">
                                    @if($platform === 'facebook')
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    @elseif($platform === 'instagram')
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    @elseif($platform === 'youtube')
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-10 pt-4" style="border-top: 1px solid rgba(250, 248, 243, 0.12);">
                <p class="text-xs" style="color: rgba(250, 248, 243, 0.55);">&copy; {{ date('Y') }} SubediSuppliers. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
