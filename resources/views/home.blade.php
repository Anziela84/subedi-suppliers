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

    <!-- Trust Strip -->
    <section class="home-trust">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ul class="home-trust-list">
                <li><strong>{{ $productCount }}</strong><span>Products in the catalogue</span></li>
                <li><strong>{{ $categories->count() }}</strong><span>Metal categories</span></li>
                @foreach (config('home.trust') as $item)
                    <li><strong>{{ $item['value'] }}</strong><span>{{ $item['label'] }}</span></li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Featured Products Carousel -->
    <section class="featured-products" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

    <!-- Shop by use -->
    <section class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="eyebrow">Find your piece</span>
                <h2 class="section-heading font-heading text-3xl font-bold">Shop by <span class="accent">use</span></h2>
            </div>
            <div class="ornament"><span></span></div>

            <div class="occasion-grid" data-reveal-stagger>
                @foreach (config('home.occasions') as $occasion)
                    <a href="{{ route('products.index', ['category' => $occasion['category']]) }}" class="occasion-tile occasion-{{ $occasion['category'] }}" data-reveal>
                        <span class="occasion-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $occasion['title'] }}</h3>
                        <p>{{ $occasion['text'] }}</p>
                        <span class="occasion-link">Explore &rarr;</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Know your metals -->
    <section class="metals-section section-dark py-16 md:py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="eyebrow metals-eyebrow">The guide</span>
                <h2 class="font-heading text-3xl md:text-4xl font-semibold" style="color: var(--color-cream, #FAF8F3);">Know your <span style="color:#C9A66B">metals</span></h2>
                <p class="metals-intro">What each one is best for, and how to keep it looking its best.</p>
            </div>

            <div class="metals-tabs" role="tablist">
                @foreach (config('home.metals') as $metal)
                    <button type="button" role="tab" class="metals-tab{{ $loop->first ? ' active' : '' }}" id="tab-{{ $metal['slug'] }}" aria-controls="panel-{{ $metal['slug'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-metal="{{ $metal['slug'] }}">{{ $metal['name'] }}</button>
                @endforeach
            </div>

            @foreach (config('home.metals') as $metal)
                <div class="metals-panel" role="tabpanel" id="panel-{{ $metal['slug'] }}" aria-labelledby="tab-{{ $metal['slug'] }}"{{ $loop->first ? '' : ' hidden' }}>
                    <h3 class="metals-tagline">{{ $metal['tagline'] }}</h3>
                    <div class="metals-cols">
                        <div>
                            <h4>Best for</h4>
                            <ul>
                                @foreach ($metal['uses'] as $use)
                                    <li>{{ $use }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h4>Care</h4>
                            <ul>
                                @foreach ($metal['care'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="metals-cta" href="{{ route('products.index', ['category' => $metal['slug']]) }}">Shop {{ $metal['name'] }} &rarr;</a>
                </div>
            @endforeach

            <p class="metals-story">Want the story behind SubediSuppliers? <a href="{{ route('about') }}">Read about us</a></p>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var tabs = document.querySelectorAll('.metals-tab');
                var panels = document.querySelectorAll('.metals-panel');

                tabs.forEach(function (tab) {
                    tab.addEventListener('click', function () {
                        tabs.forEach(function (t) {
                            t.classList.remove('active');
                            t.setAttribute('aria-selected', 'false');
                        });
                        panels.forEach(function (p) {
                            p.hidden = true;
                        });

                        tab.classList.add('active');
                        tab.setAttribute('aria-selected', 'true');
                        var panel = document.getElementById('panel-' + tab.dataset.metal);
                        if (panel) {
                            panel.hidden = false;
                        }
                    });
                });
            });
        </script>
    @endpush

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
