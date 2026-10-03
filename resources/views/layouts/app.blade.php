<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'SubediSuppliers')</title>

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
    <header class="sticky top-0 z-50 backdrop-blur border-b" style="background: var(--color-cream, #FAF8F3); border-bottom-color: var(--color-border, #D9D5CC);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="navbar" id="navbar">
                <a href="{{ route('home') }}" class="nav-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="SubediSuppliers" class="nav-logo-img">
                </a>
                <button class="navbar-toggle" id="navbarToggle" type="button"
                        aria-label="Toggle navigation" aria-expanded="false" aria-controls="navLinks">
                    <span></span><span></span><span></span>
                </button>
            </nav>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </div>
    </header>

    <main class="grow">
        @yield('content')
    </main>
    <footer class="site-footer section-dark">
        <div class="site-footer-grain" aria-hidden="true"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8">
                <div>
                    <p class="font-heading text-xl font-semibold" style="color: var(--color-cream, #FAF8F3);">SubediSuppliers</p>
                    <p class="mt-2 text-sm" style="color: rgba(250, 248, 243, 0.75);">Copper, brass, kasa, steel and aluminium — objects made to last.</p>
                    @if(config('site.whatsapp'))
                        <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded bg-[#25D366] text-white hover:bg-[#1ebc57] transition text-sm font-medium">
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
                    <div class="text-sm space-y-1" style="color: rgba(250, 248, 243, 0.8);">
                        @if(config('site.address_lines'))
                            @foreach(config('site.address_lines') as $line)
                                <p>{{ $line }}</p>
                            @endforeach
                        @endif
                        @if(config('site.business_hours'))
                            <p class="mt-2">{{ config('site.business_hours') }}</p>
                        @endif
                        @if(config('site.emails') && is_array(config('site.emails')) && count(config('site.emails')) > 0)
                            <p class="mt-2">{{ config('site.emails')[0] }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-4" style="border-top: 1px solid rgba(250, 248, 243, 0.12);">
                <p class="text-xs" style="color: rgba(250, 248, 243, 0.55);">&copy; {{ date('Y') }} SubediSuppliers. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navbarToggle = document.getElementById('navbarToggle');
            var navLinks = document.getElementById('navLinks');

            if (!navbarToggle || !navLinks) return;

            function closeMobileNav() {
                document.body.classList.remove('nav-is-open');
                navbarToggle.classList.remove('active');
                navbarToggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('no-scroll');
            }

            navbarToggle.addEventListener('click', function () {
                var isOpen = document.body.classList.toggle('nav-is-open');
                navbarToggle.classList.toggle('active', isOpen);
                navbarToggle.setAttribute('aria-expanded', isOpen);
                document.body.classList.toggle('no-scroll', isOpen);
            });

            navLinks.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMobileNav);
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) closeMobileNav();
            });
        });
    </script>
</body>
</html>
