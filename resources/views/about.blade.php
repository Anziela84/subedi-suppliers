@extends('layouts.app')

@section('title', 'About Us | SubediSuppliers')
@push('head-meta')
    <meta name="description" content="{{ config('about.intro') }}" />
@endpush

@php
    $about = config('about');
    $images = $about['images'] ?? [];
    $heroImage = $images['hero'] ?? null;
    $heroImageExists = $heroImage && file_exists(public_path($heroImage));
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
                        <a href="{{ route('products.index') }}" class="btn-primary">
                            View Our Products
                        </a>
                        <a href="{{ route('contact') }}" class="btn-secondary">
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

    @if ($categories->count())
    <section class="metal-band" aria-label="Metals we work with">
        <div class="metal-band-inner">
            <span class="metal-band-label">Metals we work with</span>
            <div class="metal-band-viewport">
                <div class="metal-band-track">
                    @for ($copy = 0; $copy < 2; $copy++)
                        <ul class="metal-band-list" @if($copy === 1) aria-hidden="true" @endif>
                            @for ($rep = 0; $rep < 2; $rep++)
                                @foreach ($categories as $category)
                                    <li class="{{ $rep === 1 ? 'is-repeat' : '' }}">
                                        <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="metal-band-item" @if($copy === 1 || $rep === 1) tabindex="-1" @endif>
                                            <span class="metal-swatch metal-swatch-{{ $category->slug }}" aria-hidden="true"></span>
                                            <span>{{ $category->name }}</span>
                                        </a>
                                        <span class="metal-band-dot" aria-hidden="true"></span>
                                    </li>
                                @endforeach
                            @endfor
                        </ul>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Chapters -->
    @if(!empty($about['chapters']))
        <section class="about-chapters py-16 md:py-24" id="story">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="about-chapters-grid">
                    <div class="about-chapters-media" aria-hidden="true">
                        <div class="about-chapters-frame">
                            @foreach ($about['chapters'] as $i => $chapter)
                                <div class="about-chapters-slide {{ $loop->first ? 'is-active' : '' }}" data-chapter="{{ $i }}">
                                    @if (!empty($chapter['image']) && file_exists(public_path($chapter['image'])))
                                        <img src="{{ asset($chapter['image']) }}" alt="" loading="lazy">
                                    @else
                                        <x-media-placeholder :name="$chapter['title']" :category="$categories->firstWhere('slug', $chapter['category'] ?? '')" class="w-full h-full" />
                                    @endif
                                    <span class="about-chapters-tag">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }} &middot; {{ $chapter['title'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="about-chapters-text">
                        @foreach ($about['chapters'] as $i => $chapter)
                            <article class="about-chapter {{ $loop->first ? 'is-active' : '' }}" data-chapter="{{ $i }}">
                                <div class="about-chapter-image">
                                    @if (!empty($chapter['image']) && file_exists(public_path($chapter['image'])))
                                        <img src="{{ asset($chapter['image']) }}" alt="{{ $chapter['title'] }}" loading="lazy">
                                    @else
                                        <x-media-placeholder :name="$chapter['title']" :category="$categories->firstWhere('slug', $chapter['category'] ?? '')" class="w-full h-full" />
                                    @endif
                                </div>
                                <span class="about-chapter-index">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h2>{{ $chapter['title'] }}</h2>
                                <p>{{ $chapter['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (!empty($about['statement']))
        <section class="about-statement section-dark">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-reveal>
                <div class="about-statement-mark" aria-hidden="true"><span></span></div>
                <p class="about-statement-text">{{ $about['statement'] }}</p>
                <a href="{{ route('products.index') }}" class="about-statement-link">Browse the collection &rarr;</a>
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

                <div class="about-pillars-grid" data-reveal-stagger>
                    @foreach ($about['values'] as $value)
                        <div class="about-pillar">
                            <span class="about-pillar-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $value['title'] }}</h3>
                            <p>{{ $value['text'] }}</p>
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

    <x-cta-band
        title="Visit us or get in touch"
        text="We would love to show you our range in person or help you find exactly what you need."
        :directions="true"
    />
@endsection
