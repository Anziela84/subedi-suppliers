@extends('layouts.app')

@section('title', $product->name)

@push('head-meta')
    @if($product->description)
        <meta name="description" content="{{ mb_substr(strip_tags($product->description), 0, 150) }}" />
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="og:description" content="{{ mb_substr(strip_tags($product->description), 0, 150) }}" />
        @if($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
            <meta property="og:image" content="{{ asset('storage/' . $product->image) }}" />
        @endif
    @endif
@endpush

@section('content')
    @php
        $gallery = $product->galleryUrls();
        $hasGallery = count($gallery) > 1;
        $relatedSameCategory = $related->filter(fn ($item) => $item->category_id === $product->category_id)->count() === $related->count();
        $highlightsKey = $product->category->slug ?? 'default';
        $highlights = config("product_highlights.{$highlightsKey}", config('product_highlights.default'));
        $whatsappMessage = urlencode('Hello, I am interested in ' . $product->name . '. Could you share details?');
    @endphp

    <section class="product-detail-section">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="product-detail-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('products.index') }}">Products</a>
                <span aria-hidden="true">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page">{{ $product->name }}</span>
            </nav>

            <div class="product-detail-grid">
                <div class="product-detail-gallery" data-gallery>
                    @if($hasGallery)
                        <div class="product-detail-thumbs">
                            <button type="button" class="product-detail-thumb-arrow product-detail-thumb-prev" aria-label="Previous image">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                            </button>
                            <div class="product-detail-thumbs-track">
                                @foreach($gallery as $index => $url)
                                    <button type="button" class="product-detail-thumb{{ $index === 0 ? ' is-active' : '' }}" data-index="{{ $index }}" aria-label="View image {{ $index + 1 }}">
                                        <img src="{{ $url }}" alt="{{ $product->name }} {{ $index + 1 }}" loading="lazy" />
                                    </button>
                                @endforeach
                            </div>
                            <button type="button" class="product-detail-thumb-arrow product-detail-thumb-next" aria-label="Next image">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                            </button>
                        </div>
                    @endif

                    <div class="product-detail-main-image-wrap">
                        <img
                            src="{{ $gallery[0] }}"
                            alt="{{ $product->name }}"
                            class="product-detail-main-image"
                            data-index="0"
                            data-total="{{ count($gallery) }}"
                        />
                        @if($hasGallery)
                            <button type="button" class="product-detail-main-arrow product-detail-main-prev" aria-label="Previous image">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                            </button>
                            <button type="button" class="product-detail-main-arrow product-detail-main-next" aria-label="Next image">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                            </button>
                            <span class="product-detail-main-counter" aria-live="polite">— 1 / {{ count($gallery) }}</span>
                        @endif
                    </div>
                </div>

                <div class="product-detail-info">
                    <span class="product-detail-eyebrow">{{ $product->category->name }}</span>
                    <h1 class="product-detail-title">{{ $product->name }}</h1>

                    <p class="product-detail-meta">
                        {{ $product->metaLine() }}
                    </p>

                    @if($product->price !== null && $product->price !== '')
                        <p class="product-detail-price">Rs {{ number_format((float) $product->price, 0) }}</p>
                    @endif

                    @if($product->description)
                        <div class="product-detail-description">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @endif

                    <div class="product-detail-specs">
                        @if($product->category)
                            <div class="product-detail-spec">
                                <span class="product-detail-spec-label">Material</span>
                                <span class="product-detail-spec-value">{{ $product->category->name }}</span>
                            </div>
                        @endif
                        @if($product->size)
                            <div class="product-detail-spec">
                                <span class="product-detail-spec-label">Size</span>
                                <span class="product-detail-spec-value">{{ $product->size }}</span>
                            </div>
                        @endif
                        @if($product->dimensions_display)
                            <div class="product-detail-spec">
                                <span class="product-detail-spec-label">Dimensions</span>
                                <span class="product-detail-spec-value">{{ $product->dimensions_display }}</span>
                            </div>
                        @endif
                        @if($product->weight_display)
                            <div class="product-detail-spec">
                                <span class="product-detail-spec-label">Weight</span>
                                <span class="product-detail-spec-value">{{ $product->weight_display }}</span>
                            </div>
                        @endif
                        @if($product->finish)
                            <div class="product-detail-spec">
                                <span class="product-detail-spec-label">Finish</span>
                                <span class="product-detail-spec-value">{{ $product->finish }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="product-detail-actions">
                        <a href="{{ config('site.whatsapp') ? 'https://wa.me/' . config('site.whatsapp') . '?text=' . $whatsappMessage : route('contact') }}" class="product-detail-btn-primary" target="_blank" rel="noopener">
                            Enquire about this product <span aria-hidden="true">&rarr;</span>
                        </a>
                        <button type="button" class="product-detail-btn-copy" id="copyLinkBtn" aria-label="Copy link">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path stroke-linecap="round" stroke-linejoin="round" d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                        </button>
                        <span class="product-detail-copy-tooltip" id="copyTooltip" aria-hidden="true">Link copied</span>
                    </div>

                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="product-detail-back">
                        &larr; Back to {{ $product->category->name }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if(is_iterable($highlights) && count($highlights))
        <section class="product-detail-highlights">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="product-detail-highlights-grid">
                    @foreach($highlights as $item)
                        <div class="product-detail-highlight">
                            <div class="product-detail-highlight-icon">
                                @switch($item['icon'])
                                    @case('leaf')
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c-1.5 3-4.5 6-9 9 4.5 3 7.5 6 9 9 1.5-3 4.5-6 9-9-4.5-3-7.5-6-9-9z"/></svg>
                                    @break
                                    @case('shield')
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 3v5c0 5-3 8-7 9-4-1-7-4-7-9V6l7-3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4"/></svg>
                                    @break
                                    @case('hand')
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 11V6a2 2 0 00-2-2 2 2 0 00-2 2v1M14 10V4a2 2 0 00-2-2 2 2 0 00-2 2v6M10 10.5V6a2 2 0 00-2-2 2 2 0 00-2 2v8"/><path stroke-linecap="round" stroke-linejoin="round" d="M18 11a2 2 0 012 2v5a6 6 0 01-6 6h-3a6 6 0 01-6-6v-3a2 2 0 012-2 2 2 0 012-2 2 2 0 012 2 2 2 0 012-2 2 2 0 012 2 2 2 0 012-2z"/></svg>
                                    @break
                                    @case('sprout')
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10V3M12 10c-2 0-4 2-4 5s2 5 4 5 4-2 4-5-2-5-4-5zM12 10c2 0 4 2 4 5s-2 5-4 5-4-2-4-5 2-5 4-5zM7 21h10"/></svg>
                                    @break
                                @endswitch
                            </div>
                            <h3 class="product-detail-highlight-title">{{ $item['title'] }}</h3>
                            <p class="product-detail-highlight-text">{{ $item['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($related->count())
        <section class="product-detail-related">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="product-detail-related-header">
                    <div>
                        @if($relatedSameCategory)
                            <span class="product-detail-related-eyebrow">MORE FROM {{ strtoupper($product->category->name) }}</span>
                        @else
                            <span class="product-detail-related-eyebrow">MORE TO EXPLORE</span>
                        @endif
                        <h2 class="product-detail-related-title">You may also like</h2>
                    </div>
                    <div class="product-detail-related-arrows">
                        <button type="button" class="product-detail-related-arrow product-detail-related-prev" aria-label="Previous">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/></svg>
                        </button>
                        <button type="button" class="product-detail-related-arrow product-detail-related-next" aria-label="Next">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6"/></svg>
                        </button>
                    </div>
                </div>

                <div class="product-detail-related-track" id="relatedTrack">
                    @foreach($related as $item)
                        <div class="product-detail-related-card">
                            <x-product-card :product="$item" />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="product-detail-bottom-spacer"></div>
@endsection
