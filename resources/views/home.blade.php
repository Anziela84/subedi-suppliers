@extends('layouts.app')

@section('title', 'SubediSuppliers')

@push('head-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endpush

@section('content')
    <!-- Hero -->
    <section class="section-dark pt-16 md:pt-24 pb-20 md:pb-28 hero-two-col">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left: Text content -->
                <div class="hero-text">
                    <span class="eyebrow hero-eyebrow" id="heroEyebrow" data-traditional="TRADITIONAL CRAFT" data-modern="EVERYDAY METALWARE">TRADITIONAL CRAFT</span>
                    <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold leading-tight" style="color: var(--color-cream, #FAF8F3);">
                        Crafted in Metal,<br>Rooted in Tradition
                    </h1>
                    <p class="mt-4 text-lg md:text-xl max-w-xl hero-desc" id="heroDesc" data-traditional="Bringing generations of Nepali craftsmanship to your home." data-modern="Reliable metal products made for everyday living." style="color: rgba(250, 248, 243, 0.85);">
                        Bringing generations of Nepali craftsmanship to your home.
                    </p>
                    <div class="mt-8 hero-cta">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 rounded btn-primary font-medium transition">View Our Products</a>
                    </div>
                </div>
                <!-- Right: Visual scene layers -->
                <div class="hero-visual">
                    <div class="hero-scene hero-traditional">
                        <img src="{{ asset('images/khasaimage.png') }}" alt="Traditional Nepali metalware" class="hero-scene-img" />
                    </div>
                    <div class="hero-scene hero-modern">
                        <img src="{{ asset('images/steelimage.png') }}" alt="Everyday modern metalware" class="hero-scene-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Carousel -->
    <section class="featured-products" style="background: var(--color-cream, #FAF8F3);">
        <div class="text-center">
            <span class="eyebrow">Our range</span>
            <h2 class="section-heading text-center font-heading text-3xl font-bold">Featured <span class="accent">Products</span></h2>
        </div>
        <div class="ornament"><span></span></div>

        <div class="swiper featured-swiper">
            <div class="swiper-wrapper">
                @foreach ($featuredProducts as $product)
                    <div class="swiper-slide">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>

    <!-- Shop by Category -->
    <section id="categories" class="py-16 md:py-24" style="background: var(--color-sand, #F5F1E8);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="eyebrow">Browse</span>
                <h2 class="section-heading text-center font-heading text-3xl font-bold">Shop by <span class="accent">Category</span></h2>
            </div>
            <div class="ornament"><span></span></div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group category-card rounded-xl overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="aspect-square" style="background: var(--color-sand, #F5F1E8);">
                            @if($category->image && file_exists(storage_path('app/public/' . $category->image)))
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" />
                            @else
                                <x-media-placeholder :name="$category->name" :category="$category" class="w-full h-full" />
                            @endif
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-heading font-semibold" style="color: var(--color-ink, #1E252B);">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Brand Story Teaser -->
    <section id="about" class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="eyebrow">Our story</span>
            <h2 class="section-heading font-heading text-3xl font-bold mb-4">Heritage & <span class="accent">Craft</span></h2>
            <div class="ornament"><span></span></div>
            <p class="mt-4 leading-relaxed" style="color: var(--color-ink, #1E252B);">
                For generations, SubediSuppliers has connected Nepali artisans with homes that value true craftsmanship.
                Every piece we supply carries the legacy of metalwork traditions passed down through families — shaped by hand,
                finished with care, and built to last.
            </p>
            <a href="{{ route('about') }}" class="inline-flex items-center mt-6 text-brand-blue font-medium hover:underline">Learn more about us
                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </section>

    @section('scripts')
        <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.featured-swiper', {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                    loop: true,
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: { slidesPerView: 2.2 },
                        1024: { slidesPerView: 4 },
                    },
                });
            });

            (function() {
                var traditional = document.querySelector('.hero-traditional');
                var modern = document.querySelector('.hero-modern');
                var eyebrow = document.getElementById('heroEyebrow');
                var desc = document.getElementById('heroDesc');

                if (!traditional || !modern) return;

                var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

                var sceneDuration = 7000;
                var transitionDuration = 1200;
                var intervalId = null;

                function startCycling() {
                    intervalId = setInterval(function() {
                        if (traditional.classList.contains('active')) {
                            traditional.classList.remove('active');
                            modern.classList.add('active');
                            if (eyebrow && desc) {
                                fadeText(eyebrow, eyebrow.dataset.modern);
                                fadeText(desc, desc.dataset.modern);
                            }
                        } else {
                            modern.classList.remove('active');
                            traditional.classList.add('active');
                            if (eyebrow && desc) {
                                fadeText(eyebrow, eyebrow.dataset.traditional);
                                fadeText(desc, desc.dataset.traditional);
                            }
                        }
                    }, sceneDuration + transitionDuration);
                }

                if (reducedMotion) {
                    traditional.classList.add('active');
                    modern.classList.remove('active');
                    return;
                }

                setTimeout(function() {
                    traditional.classList.add('active');
                    startCycling();
                }, 300);

                function fadeText(el, newText) {
                    if (!el) return;
                    el.style.transition = 'opacity 0.4s ease';
                    el.style.opacity = '0';
                    setTimeout(function() {
                        el.textContent = newText;
                        el.style.opacity = '1';
                    }, 400);
                }
            })();
        </script>
    @endsection
@endsection
