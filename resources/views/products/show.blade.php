@extends('layouts.app')

@section('title', $product->name)

@push('head-meta')
    @if($product->description)
        <meta name="description" content="{{ mb_substr(strip_tags($product->description), 0, 150) }}" />
        <meta property="og:title" content="{{ $product->name }}" />
        <meta property="og:description" content="{{ mb_substr(strip_tags($product->description), 0, 150) }}" />
        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
            <meta property="og:image" content="{{ asset('storage/' . $product->image) }}" />
        @endif
    @endif
@endpush

@section('content')
    <section class="page-banner section-dark page-banner--compact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm" style="color: rgba(250, 248, 243, 0.8);">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span>/</span>
                <a href="{{ route('products.index') }}" class="hover:underline">Products</a>
                <span>/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:underline">{{ $product->category->name }}</a>
                <span>/</span>
                <span style="color: var(--color-cream, #FAF8F3);">{{ $product->name }}</span>
            </nav>
        </div>
    </section>

    <section class="py-12 md:py-20" style="background: var(--color-cream, #FAF8F3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">
                <div class="product-detail-media lg:sticky lg:top-28">
                    <div class="product-detail-frame">
                        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain" />
                        @else
                            <x-media-placeholder :name="$product->name" :category="$product->category" class="w-full h-full" />
                        @endif
                    </div>
                </div>

                <div class="product-detail-info space-y-5">
                    <span class="product-badge">{{ $product->category->name }}</span>
                    <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold mt-1" style="color: var(--color-ink, #1E252B); line-height: 1.1;">{{ $product->name }}</h1>

                    <p class="text-lg">
                        @if($product->price !== null && $product->price !== '')
                            <span class="price-value">Rs {{ number_format((float) $product->price, 0) }}</span>
                        @else
                            <span class="price-muted">Enquire for price</span>
                        @endif
                    </p>

                    @if($product->description)
                        <div class="prose max-w-none" style="color: var(--color-ink, #1E252B);">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @endif

                    @if($product->dimensions || $product->size || $product->weight)
                        <div class="product-specs-table">
                            <table class="w-full text-sm">
                                <tbody>
                                    @if($product->dimensions)
                                        <tr class="border-b" style="border-color: var(--color-border, #D9D5CC);">
                                            <td class="px-4 py-3 font-medium" style="color: var(--color-ink, #1E252B); opacity: 0.7; width: 40%;">Dimensions</td>
                                            <td class="px-4 py-3" style="color: var(--color-ink, #1E252B);">{{ $product->dimensions }}</td>
                                        </tr>
                                    @endif
                                    @if($product->size)
                                        <tr class="border-b" style="border-color: var(--color-border, #D9D5CC);">
                                            <td class="px-4 py-3 font-medium" style="color: var(--color-ink, #1E252B); opacity: 0.7; width: 40%;">Size</td>
                                            <td class="px-4 py-3" style="color: var(--color-ink, #1E252B);">{{ $product->size }}</td>
                                        </tr>
                                    @endif
                                    @if($product->weight)
                                        <tr>
                                            <td class="px-4 py-3 font-medium" style="color: var(--color-ink, #1E252B); opacity: 0.7; width: 40%;">Weight</td>
                                            <td class="px-4 py-3" style="color: var(--color-ink, #1E252B);">{{ $product->weight }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        @if(config('site.whatsapp'))
                            <a href="https://wa.me/{{ config('site.whatsapp') }}?text={{ urlencode('Hello, I am interested in ' . $product->name . '. Could you share details?') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-6 py-3 rounded-lg btn-primary font-medium transition">
                                Enquire on WhatsApp
                            </a>
                        @endif
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border font-medium transition hover:bg-white/50" style="border-color: var(--color-border, #D9D5CC); color: var(--color-ink, #1E252B);">
                            Contact us
                        </a>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-sm hover:underline" style="color: var(--color-brand-blue, #0047AB);">
                            &larr; Back to {{ $product->category->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($related->count())
        <section class="py-16 md:py-24" style="background: var(--color-sand, #F5F1E8);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <span class="eyebrow">More</span>
                    <h2 class="section-heading text-center font-heading text-3xl font-bold">You may also <span class="accent">like</span></h2>
                </div>
                <div class="ornament"><span></span></div>

                <div class="products-grid">
                    @foreach($related as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
