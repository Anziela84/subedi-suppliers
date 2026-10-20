@extends('layouts.app')

@section('title', 'About Us | SubediSuppliers')

@section('meta_description', config('about.intro'))

@php
    $about = config('about');

    // Resolve an image base name (no extension) to the first file that exists.
    // Order: .webp > .jpg > .jpeg > .png
    $resolveImage = function (?string $base): ?string {
        if (empty($base)) {
            return null;
        }

        foreach (['webp', 'jpg', 'jpeg', 'png'] as $ext) {
            $candidate = $base . '.' . $ext;

            if (file_exists(public_path($candidate))) {
                return $candidate;
            }
        }

        return null;
    };

    $heroImage = $resolveImage($about['images']['hero'] ?? null);
    $rangeImage = $resolveImage($about['images']['range'] ?? null);
    $promiseImage = $resolveImage($about['images']['promise'] ?? null);

    $chapters = $about['chapters'] ?? [];

    // Resolve a chapter link: either a ready-made 'url' or a 'route' name + 'params'
    $resolveLink = function (?array $link): ?string {
        if (empty($link)) {
            return null;
        }

        if (!empty($link['url'])) {
            return $link['url'];
        }

        if (!empty($link['route'])) {
            return route($link['route'], $link['params'] ?? []);
        }

        return null;
    };

    // Contact details come from config/site.php only
    $addressLines = config('site.address_lines', []);
    $town = $addressLines[0] ?? null;
    $directionsUrl = config('site.map_directions_url');
    $businessHours = config('site.business_hours');
@endphp

@section('content')
<div class="ab-page ab2-page">

    <!-- 1. HERO -->
    <section class="ab2-hero">
        <div class="ab2-hero-grid {{ $heroImage ? '' : 'ab2-hero-grid--no-media' }}">
            <div class="ab2-hero-copy" data-reveal>
                <span class="ab-eyebrow"><span class="ab-eyebrow-line" aria-hidden="true"></span>About Us</span>
                <h1 class="ab2-h1">Traditional values. Modern <em class="ab2-em">needs.</em></h1>
                <p class="ab2-lead">{{ $about['intro'] }}</p>
            </div>

            @if($heroImage)
                <div class="ab2-hero-media" data-reveal>
                    <figure class="ab2-hero-frame">
                        <img src="{{ asset($heroImage) }}"
                             alt="Brass and copper puja set arranged on a wooden tray"
                             width="1536" height="1024"
                             loading="eager" fetchpriority="high">
                    </figure>
                </div>
            @endif
        </div>
    </section>

    <!-- 2. OUR PRODUCT RANGE — STICKY CHAPTERS -->
    @if(!empty($chapters))
        <section class="about-chapters ab2-range" id="story">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <header class="ab2-range-head" data-reveal>
                    <span class="ab-eyebrow"><span class="ab-eyebrow-line" aria-hidden="true"></span>Our product range</span>
                    <h2 class="ab2-h2">Two traditions. One destination.</h2>
                    <p class="ab2-range-intro">We offer a curated selection of traditional Khasa products and high-quality metalware, crafted for both everyday use and special occasions. From cultural essentials to kitchen and household items, our products are chosen to bring quality, durability and tradition into your home.</p>
                </header>

                {{-- The photo is pinned under the header on small screens and sticky on the right on desktop --}}
                <div class="about-chapters-grid ab2-range-grid">
                    <div class="about-chapters-media">
                        <div class="about-chapters-frame">
                            @foreach ($chapters as $i => $chapter)
                                <div class="about-chapters-slide {{ $loop->first ? 'is-active' : '' }}" data-chapter="{{ $i }}">
                                    @if($rangeImage)
                                        <img src="{{ asset($rangeImage) }}"
                                             alt="{{ $loop->first ? 'Shop shelves filled with brass, copper and steel metalware' : '' }}"
                                             width="1448" height="1086"
                                             loading="lazy"
                                             style="--ab2-focus-position: {{ $chapter['focus']['position'] ?? '50% 50%' }}; --ab2-focus-scale: {{ $chapter['focus']['scale'] ?? '1' }};">
                                    @endif
                                    <span class="about-chapters-tag">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }} &middot; {{ $chapter['title'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="about-chapters-text">
                        @foreach ($chapters as $i => $chapter)
                            <article class="about-chapter {{ $loop->first ? 'is-active' : '' }}" data-chapter="{{ $i }}">
                                <span class="about-chapter-index">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3 class="ab2-chapter-title">{{ $chapter['title'] }}</h3>
                                <p class="ab2-chapter-text">{{ $chapter['text'] }}</p>
                                @php $chapterLink = $resolveLink($chapter['link'] ?? null); @endphp
                                @if($chapterLink)
                                    <a class="ab2-chapter-link" href="{{ $chapterLink }}">{{ $chapter['link']['label'] }}</a>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 3. OUR PROMISE -->
    <section class="ab2-promise">
        <div class="ab2-promise-grid {{ $promiseImage ? '' : 'ab2-promise-grid--no-media' }}">
            @if($promiseImage)
                <div class="ab2-promise-media">
                    <img src="{{ asset($promiseImage) }}"
                         alt="Close-up of an engraved brass plate resting on dark navy cloth"
                         width="1448" height="1086"
                         loading="lazy">
                </div>
            @endif

            <div class="ab2-promise-content" data-reveal>
                <span class="ab-eyebrow ab-eyebrow-light"><span class="ab-eyebrow-line" aria-hidden="true"></span>Our promise</span>
                <h2 class="ab2-h2 ab2-h2--light">Chosen with care. Offered with honesty.</h2>
                <p class="ab2-promise-lead">We believe in good products, fair prices and genuine service. That's why we focus on:</p>

                <div class="ab2-promise-items">
                    <div class="ab2-promise-item">
                        <span class="ab2-promise-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 3l7 3v5.2c0 4.4-2.9 8.3-7 9.8-4.1-1.5-7-5.4-7-9.8V6l7-3z"/>
                                <path d="M9.2 12.1l2 2 3.6-3.7"/>
                            </svg>
                        </span>
                        <h3 class="ab2-promise-title">Quality Products</h3>
                        <p class="ab2-promise-text">Well-made, durable and carefully selected.</p>
                    </div>

                    <div class="ab2-promise-item">
                        <span class="ab2-promise-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="8" r="3"/>
                                <path d="M2.8 19.4c0-3 2.8-5.4 6.2-5.4s6.2 2.4 6.2 5.4"/>
                                <path d="M16.4 5.6a2.6 2.6 0 0 1 0 5"/>
                                <path d="M17.4 14.3c2.3.5 3.8 2.2 3.8 5.1"/>
                            </svg>
                        </span>
                        <h3 class="ab2-promise-title">Honest Guidance</h3>
                        <p class="ab2-promise-text">Real advice, not just sales.</p>
                    </div>

                    <div class="ab2-promise-item">
                        <span class="ab2-promise-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20.3l-1.1-1C6.1 15 3 12.2 3 8.8 3 6.1 5.1 4 7.8 4c1.5 0 3 .7 4.2 2 1.1-1.3 2.6-2 4.2-2C18.9 4 21 6.1 21 8.8c0 3.4-3.1 6.2-7.9 10.5l-1.1 1z"/>
                            </svg>
                        </span>
                        <h3 class="ab2-promise-title">Lasting Relationships</h3>
                        <p class="ab2-promise-text">We value every customer who walks through our door.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. VISIT US -->
    <section class="ab2-visit">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="ab2-visit-inner" data-reveal>
                <span class="ab-eyebrow"><span class="ab-eyebrow-line" aria-hidden="true"></span>Visit us</span>
                <h2 class="ab2-h2">Good things are better seen in person.</h2>
                <p class="ab2-visit-text">Explore our collection at our store{{ $town ? ' in '.$town : '' }} or get in touch for any enquiries. We're here to help.</p>

                <div class="ab2-visit-actions">
                    <a class="ab2-btn" href="{{ route('products.index') }}">Explore products <span aria-hidden="true">&rarr;</span></a>

                    @if(!empty($directionsUrl) && $town)
                        <a class="ab2-directions" href="{{ $directionsUrl }}" target="_blank" rel="noopener">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/>
                                <path d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            </svg>
                            <span>Find us in {{ $town }}</span>
                        </a>
                    @endif
                </div>

                @if(!empty($businessHours))
                    <p class="ab2-visit-hours">Open {{ $businessHours }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Legacy conditional sections (render only when config data is non-empty) -->
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

</div>
@endsection
