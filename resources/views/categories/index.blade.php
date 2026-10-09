@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    @php
        // Uploaded image first, then the bundled fallback photo for each metal.
        $fallbacks = [
            'copper'    => 'images/copper.png',
            'brass'     => 'images/brass.png',
            'kasa'      => 'images/khasaimage.png',
            'steel'     => 'images/steelimage.png',
            'aluminium' => 'images/aluminium.jfif',
        ];
        $imageFor = function ($category) use ($fallbacks) {
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                return asset('storage/' . $category->image);
            }
            return isset($fallbacks[$category->slug]) ? asset($fallbacks[$category->slug]) : null;
        };
    @endphp

    <div class="cat-page">

        {{-- Hero: centered title + jump-to-metal swatches --}}
        <section class="cat-hero">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <span class="cat-hero-eyebrow">The Materials</span>
                <h1 class="cat-hero-title">Browse by metal.</h1>
                <div class="cat-hero-ornament" aria-hidden="true"><span></span></div>
                <p class="cat-hero-text">Find pieces by the metal they are made from.</p>

                @if($categories->count())
                    <nav class="cat-swatches" aria-label="Jump to a metal">
                        @foreach ($categories as $category)
                            <a href="#cat-{{ $category->slug }}" class="cat-swatch" style="--i: {{ $loop->index }};">
                                <span class="cat-swatch-img">
                                    @if($imageFor($category))
                                        <img src="{{ $imageFor($category) }}" alt="" loading="lazy" />
                                    @endif
                                </span>
                                <span class="cat-swatch-label">{{ $category->name }}</span>
                            </a>
                        @endforeach
                    </nav>
                @endif
            </div>
        </section>

        {{-- Category rows --}}
        <section class="cat-list">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($categories->count())
                    @foreach ($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           id="cat-{{ $category->slug }}"
                           class="cat-row"
                           data-reveal>
                            <div class="cat-row-body">
                                <span class="cat-row-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h2>{{ $category->name }}</h2>
                                <p class="cat-row-desc">{{ $category->description }}</p>
                                @if($category->products->count())
                                    <p class="cat-row-includes">
                                        <span>Includes</span>
                                        {{ $category->products->take(3)->pluck('name')->join(', ') }}
                                    </p>
                                @endif
                                <div class="cat-row-foot">
                                    <span class="cat-row-count">{{ $category->active_products_count === 1 ? '1 product' : $category->active_products_count . ' products' }}</span>
                                    <span class="cat-row-cta">Browse {{ $category->name }} <span aria-hidden="true">&rarr;</span></span>
                                </div>
                            </div>

                            <div class="cat-row-media">
                                <div class="cat-photo">
                                    <div class="cat-photo-zoom">
                                        @if($imageFor($category))
                                            <img src="{{ $imageFor($category) }}" alt="{{ $category->name }}" loading="lazy" data-parallax />
                                        @else
                                            <x-media-placeholder :name="$category->name" :category="$category" class="cat-photo-placeholder" />
                                        @endif
                                    </div>
                                </div>
                                <span class="cat-row-arrow" aria-hidden="true">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center" data-reveal>
                        <p class="mt-4 max-w-2xl mx-auto" style="color: var(--color-ink, #1E252B);">
                            Our categories are being updated. Please check back soon or <a href="{{ route('contact') }}" class="underline">contact us</a>.
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <div class="cat-cta-wrap" data-reveal>
            <x-cta-band
                title="Can't find what you need?"
                text="Tell us what you are looking for and we will help you find it."
            />
        </div>
    </div>
@endsection