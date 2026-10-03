@extends('layouts.app')

@section('title', 'About Us | SubediSuppliers')
@push('head-meta')
    <meta name="description" content="{{ config('about.intro') }}" />
@endpush

@php
    $about = config('about');
    $images = $about['images'] ?? [];
    $heroImage = $images['hero'] ?? null;
    $storyImage = $images['story'] ?? null;
    $heroImageExists = $heroImage && file_exists(public_path($heroImage));
    $storyImageExists = $storyImage && file_exists(public_path($storyImage));
@endphp

@section('content')
    <!-- Hero -->
    <section class="section-dark about-hero">
        <div class="about-hero-grain" aria-hidden="true"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center py-16 md:py-24">
                <div class="about-hero-content" data-reveal>
                    <div class="about-hero-hairline" aria-hidden="true"></div>
                    <span class="eyebrow" style="color: var(--color-heritage, #9A7448);">OUR STORY</span>
                    <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mt-3" style="color: var(--color-cream, #FAF8F3);">
                        {{ $about['headline'] }}
                    </h1>
                    <p class="mt-5 text-lg md:text-xl max-w-xl" style="color: rgba(250, 248, 243, 0.85);">
                        {{ $about['intro'] }}
                    </p>
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl btn-primary font-medium transition">
                            View Our Products
                        </a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-xl border font-medium transition hover:bg-white/10" style="border-color: rgba(250,248,243,0.25); color: var(--color-cream, #FAF8F3);">
                            Contact Us
                        </a>
                    </div>
                </div>
                <div class="about-hero-image" data-reveal>
                    <div class="about-hero-image-wrap">
                        @if($heroImageExists)
                            <img src="{{ asset($heroImage) }}" alt="About SubediSuppliers" class="about-hero-img" fetchpriority="high" />
                        @else
                            <x-media-placeholder name="About" :category="null" class="w-full h-full" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story -->
    <section class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">
                <div class="lg:col-span-3" data-reveal>
                    <div class="lg:sticky lg:top-28">
                        <h2 class="font-heading text-3xl font-bold" style="color: var(--color-ink, #1E252B);">Our Story</h2>
                        <div class="about-story-line" aria-hidden="true"></div>
                    </div>
                </div>
                <div class="lg:col-span-9" data-reveal>
                    @php $story = $about['story'] ?? ['quote' => '', 'paragraphs' => []] @endphp

                    @if(empty($story['paragraphs']))
                        <p class="text-lg leading-relaxed" style="color: var(--color-ink, #1E252B);">
                            We supply handcrafted and everyday metalware in copper, brass, kasa, steel and aluminium.
                        </p>
                    @else
                        @foreach($story['paragraphs'] as $paragraph)
                            <p class="text-lg leading-relaxed mb-4" style="color: var(--color-ink, #1E252B);">
                                {{ $paragraph }}
                            </p>
                        @endforeach

                        @if(!empty($story['quote']))
                            <blockquote class="about-story-quote">
                                <span class="about-story-quote-mark" aria-hidden="true">"</span>
                                {{ $story['quote'] }}
                            </blockquote>
                        @endif
                    @endif

                    @if($storyImageExists)
                        <div class="mt-10">
                            <div class="rounded-2xl overflow-hidden" style="aspect-ratio: 16/9;">
                                <img src="{{ asset($storyImage) }}" alt="Our story" class="w-full h-full object-cover" loading="lazy" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- What We Supply -->
    @if($categories->count())
        <section class="py-16 md:py-24" style="background: var(--color-sand, #F5F1E8);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-reveal>
                    <span class="eyebrow">Our Range</span>
                    <h2 class="section-heading text-center font-heading text-3xl font-bold">What We Supply</h2>
                    <div class="ornament"><span></span></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12" data-reveal-stagger>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="about-category-card group block">
                            <div class="about-category-image">
                                @if($category->image && file_exists(storage_path('app/public/' . $category->image)))
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" loading="lazy" />
                                @else
                                    <x-media-placeholder :name="$category->name" :category="$category" class="w-full h-full" />
                                @endif
                                <div class="about-category-overlay"></div>
                            </div>
                            <div class="about-category-body">
                                <h3 class="font-heading text-xl font-bold" style="color: var(--color-ink, #1E252B);">{{ $category->name }}</h3>
                                <p class="mt-1 text-sm line-clamp-2" style="color: var(--color-muted, #68717A);">{{ $category->description ?: 'Handpicked ' . $category->name . ' products for every need.' }}</p>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-sm font-medium" style="color: var(--color-brand-blue, #0047AB);">{{ $category->products_count }} product{{ $category->products_count === 1 ? '' : 's' }}</span>
                                    <span class="about-category-arrow" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- What We Stand For -->
    @if(!empty($about['values']))
        <section class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-reveal>
                    <span class="eyebrow">Principles</span>
                    <h2 class="section-heading text-center font-heading text-3xl font-bold">What We Stand For</h2>
                    <div class="ornament"><span></span></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12" data-reveal-stagger>
                    @foreach($about['values'] as $value)
                        <div class="about-value-card">
                            <div class="about-value-icon">
                                @if($value['icon'] === 'hammer')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.4 13a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
                                @elseif($value['icon'] === 'shield')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                @elseif($value['icon'] === 'handshake')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 11.5V7a2 2 0 012-2h7.172a2 2 0 011.414.586l1.828 1.828A2 2 0 0119 9.828V17a2 2 0 01-2 2h-1.5M7 11.5V17a2 2 0 01-2 2H3.5M7 11.5h10.5"/></svg>
                                @elseif($value['icon'] === 'chat')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                @endif
                            </div>
                            <h3 class="font-heading text-lg font-bold mt-4" style="color: var(--color-ink, #1E252B);">{{ $value['title'] }}</h3>
                            <p class="mt-2 text-sm" style="color: var(--color-muted, #68717A);">{{ $value['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- How It Reaches You -->
    @if(!empty($about['process']))
        <section class="py-16 md:py-24" style="background: var(--color-sand, #F5F1E8);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center" data-reveal>
                    <span class="eyebrow">Process</span>
                    <h2 class="section-heading text-center font-heading text-3xl font-bold">How It Reaches You</h2>
                    <div class="ornament"><span></span></div>
                </div>

                <div class="about-process mt-12" data-reveal-stagger>
                    @foreach($about['process'] as $index => $step)
                        <div class="about-process-item">
                            <div class="about-process-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="about-process-content">
                                <h3 class="font-heading text-lg font-bold" style="color: var(--color-ink, #1E252B);">{{ $step['title'] }}</h3>
                                <p class="mt-1 text-sm" style="color: var(--color-muted, #68717A);">{{ $step['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Numbers -->
    @if(!empty($about['stats']))
        <section class="py-16 md:py-24 section-dark about-stats">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8" data-reveal-stagger>
                    @foreach($about['stats'] as $stat)
                        <div class="text-center">
                            <div class="font-heading text-4xl md:text-5xl font-bold" style="color: var(--color-cream, #FAF8F3);">
                                <span class="about-stat-value" data-target="{{ $stat['value'] }}">0</span>{{ $stat['suffix'] ?? '' }}
                            </div>
                            <p class="mt-2 text-sm" style="color: rgba(250, 248, 243, 0.7);">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Founder Note -->
    @if(!empty($about['founder']))
        <section class="py-16 md:py-24" style="background: var(--color-cream, #FAF8F3);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                    <div class="lg:col-span-4" data-reveal>
                        <div class="rounded-2xl overflow-hidden" style="aspect-ratio: 3/4;">
                            @php $founderPhoto = $about['founder']['photo'] ?? null; @endphp
                            @if($founderPhoto && file_exists(public_path($founderPhoto)))
                                <img src="{{ asset($founderPhoto) }}" alt="{{ $about['founder']['name'] }}" class="w-full h-full object-cover" loading="lazy" />
                            @else
                                <x-media-placeholder name="{{ $about['founder']['name'] }}" class="w-full h-full" />
                            @endif
                        </div>
                    </div>
                    <div class="lg:col-span-8" data-reveal>
                        <span class="eyebrow">Founder</span>
                        <h2 class="font-heading text-3xl font-bold mt-2" style="color: var(--color-ink, #1E252B);">{{ $about['founder']['name'] }}</h2>
                        <p class="mt-1 text-sm" style="color: var(--color-muted, #68717A);">{{ $about['founder']['role'] }}</p>
                        @if(!empty($about['founder']['note']))
                            <blockquote class="about-story-quote mt-6">
                                <span class="about-story-quote-mark" aria-hidden="true">"</span>
                                {{ $about['founder']['note'] }}
                            </blockquote>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Closing CTA -->
    <section class="py-16 md:py-24 section-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-reveal>
            <h2 class="font-heading text-3xl md:text-4xl font-bold" style="color: var(--color-cream, #FAF8F3);">Visit Us or Get in Touch</h2>
            <p class="mt-3 text-lg" style="color: rgba(250, 248, 243, 0.85);">We would love to show you our range in person or help you find exactly what you need.</p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ config('site.map_directions_url') }}" target="_blank" rel="noopener" class="inline-flex items-center px-6 py-3 rounded-xl btn-primary font-medium transition">
                    Get Directions
                </a>
                @if(config('site.whatsapp'))
                    <a href="https://wa.me/{{ config('site.whatsapp') }}" target="_blank" rel="noopener" class="inline-flex items-center px-6 py-3 rounded-xl border font-medium transition hover:bg-white/10" style="border-color: rgba(250,248,243,0.25); color: var(--color-cream, #FAF8F3);">
                        Chat on WhatsApp
                    </a>
                @endif
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 rounded-xl border font-medium transition hover:bg-white/10" style="border-color: rgba(250,248,243,0.25); color: var(--color-cream, #FAF8F3);">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection
